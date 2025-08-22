import Alpine from 'alpinejs'
import { apiFetch } from './fetch';
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Alpine = Alpine
window.Pusher = Pusher

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS: location.protocol === 'https:',
    enabledTransports: ['ws', 'wss'],
})

document.addEventListener('alpine:init', () => {
    Alpine.data('comments', ({ type, id }) => ({
        userId: Number(document.getElementById('auth-user').dataset.userId),
        type,
        id,
        isReplying: false,
        isCommenting: false,
        commentsList: [],
        isLoading: true,
        showReport: false,
        formReport: {
            comment_id: null,
            category: 'other',
            reason: '',
        },
        form: {
            content: '',
            commentable_id: id,
            commentable_type: type,
            parent_id: '',
            parent_user: ''
        },
        errors: {},
        init() {
            this.loadComments()

            const channelName = `comments.${this.type}.${this.id}`
            
            console.log("Echo chargé ?", window.Echo)

            window.Echo.channel(channelName)
                .listen('CommentPosted', (e) => {
                    if (e.comment.parent_id) {
                        let parent = findCommentById(this.commentsList, e.comment.parent_id)
                        if (parent) {
                            if (!parent.replies) parent.replies = []
                            parent.replies.push(e.comment)
                            parent.showReplies = true
                        }
                    } else {
                        this.commentsList.unshift(e.comment)
                    }
                })
                .listen('CommentDeleted', (e) => {
                    this.commentsList = this.commentsList.filter(c => c.id !== e.commentId)
                    this.commentsList.forEach(c => {
                        if (c.replies) c.replies = c.replies.filter(r => r.id !== e.commentId)
                    })
                })
        },

        toggleComment() {
            this.isCommenting = !this.isCommenting;
            if (this.isCommenting) {
                this.loadComments(type);
            } else {
                this.form.parent_id = ''
                this.form.parent_user = ''
            }
        },

        toggleReply() {
            this.isReplying = !this.isReplying;
        },

        toogleMenu(comment) {
            comment.menuOn = !comment.menuOn
        },

        loadComments() {
            apiFetch(`/${this.type}/${this.id}/comments/`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        this.commentsList = response.data;
                    } else {
                        console.error('Failed to load comments:', response.status);
                    }
                })
                .catch(error => {
                    console.error('Error fetching comments:', error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },

        loadReplies(comment, parent = null) {
            apiFetch(`/comments/${comment.id}/replies`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        if (parent) {
                            parent.replies = [...parent.replies, ...response.data]
                        }
                        comment.replies = response.data
                        comment.showReplies = true
                    } else {
                        console.error('Failed to load replies:', response.status);
                    }
                })
                .catch(error => {
                    console.error('Error fetching replies:', error);
                });
        },

        hideReply(comment) {
            comment.showReplies = false;
        },

        postComment() {
            apiFetch(`/comments/`, {
                method: 'POST',
                data: this.form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(response => {
                    if (response.ok) {
                        // pas besoin de reload → Reverb ajoutera en live
                        this.isCommenting = false;
                        this.form.content = ''
                        this.form.parent_id = ''
                    } else {
                        console.error('Failed to post comment:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });
        },

        replyComment(parent) {
            this.form.parent_id = parent.id;
            this.form.parent_user = parent.user.full_name;
            this.isCommenting = true;
        },

        deleteComment(id) {
            apiFetch(`/comments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Comment deleted successfully');
                        this.loadComments();
                    } else {
                        console.error('Failed to delete comment:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error deleting comment:', error);
                });
        },

        showRepostModal(comment) {
            this.formReport.comment_id = comment.id;
            this.showReport = true;
        },

        reportComment() {
            apiFetch(`/comments/${this.formReport.comment_id}/report`, {
                method: 'POST',
                data: this.formReport,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(response => {
                    if (response.ok) {
                        this.formReport.comment_id = null;
                        this.showReport = false;
                    } else {
                        this.errors = response.data.errors
                        console.log(this.errors.reason[0])
                        console.error('Failed to post report:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error posting report:', error);
                });
        },
    }));
});

Alpine.start()
