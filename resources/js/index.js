import Alpine from 'alpinejs'
import { apiFetch } from './fetch';
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Alpine = Alpine
window.Pusher = Pusher

// const forceTLS = import.meta.env.VITE_FORCE_TLS === 'true'; // convertit string en booléen

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: forceTLS,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     enabledTransports: ['ws', 'wss'],
// })

// // Assure-toi que Echo est bien instancié
// const pusher = window.Echo.connector.pusher;

// if (pusher) {
//     pusher.connection.bind('connected', () => {
//         console.log('Reverb connecté');
//     });

//     pusher.connection.bind('disconnected', () => {
//         console.log('Reverb déconnecté');
//     });

//     pusher.connection.bind('error', (err) => {
//         console.error('Erreur Reverb:', err);
//     });
// }


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
        deleting: false,
        deleting_id: null,

        processing: false,

        showDeleteModal: false,

        commentToDelete: null,

        formReport: {
            comment_id: null,
            category: 'other',
            reason: '',
        },
        form: {
            comment_id: null,
            content: '',
            commentable_id: id,
            commentable_type: type,
            parent_id: '',
            parent_user: '',
            errors : null,
        },
        errors: {},
        init() {
            this.loadComments()

            // const channelName = `comments.${this.type}.${this.id}`


            // window.Echo.channel(channelName)
            //     .listen('CommentPosted', (e) => {
            //         if (e.comment.parent_id) {
            //             let parent = findCommentById(this.commentsList, e.comment.parent_id)
            //             if (parent) {
            //                 if (!parent.replies) parent.replies = []
            //                 parent.replies.push(e.comment)
            //                 parent.showReplies = true
            //             }
            //         } else {
            //             this.commentsList.unshift(e.comment)
            //         }
            //     })
            //     .listen('CommentDeleted', (e) => {
            //         this.commentsList = this.commentsList.filter(c => c.id !== e.commentId)
            //         this.commentsList.forEach(c => {
            //             if (c.replies) c.replies = c.replies.filter(r => r.id !== e.commentId)
            //         })
            //     })
        },

        toggleComment() {
            this.isCommenting = !this.isCommenting;
            if (this.isCommenting) {
                this.loadComments(type);
            } else {

                this.form = {
                    comment_id: null,
                    content: '',
                    parent_id: '',
                    parent_user: '',
                    error: null,
                }
            }
        },

        toggleReply() {
            this.isReplying = !this.isReplying;
            if (this.isReplying) {
                this.loadComments(type);
            } else {

                this.form = {
                    comment_id: null,
                    content: '',
                    parent_id: '',
                    parent_user: '',
                    error: null,
                }
            }
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
            if (this.form.comment_id) {
                return this.updateComment();
            }
            this.processing = true
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
                        this.processing = false;
                        this.form.content = ''
                        this.form.parent_id = ''
                        this.loadComments();
                    } else {
                        // console.error('Failed to post comment:', response.status, response.data);
                        this.form.errors = response.data.errors
                        console.log(this.form.errors.content[0])
                        this.processing = false;
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

        showUpdate(comment) {
            this.form.content = comment.content;
            this.form.comment_id = comment.id;
            this.isCommenting = true;
        },

        updateComment() {
            this.processing = true;
            apiFetch(`/comments/${this.form.comment_id}`, {
                method: 'PUT',
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
                        this.processing = true;
                        this.loadComments();
                    } else {
                        this.form.errors = response.data.errors
                        console.error('Failed to post comment:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });
        },

        confirmDelete() {
            if (this.commentToDelete) {
                this.processing = true
                apiFetch(`/comments/${this.commentToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            this.processing = false;
                            this.loadComments();
                        } else {
                            console.error('Failed to delete comment:', response.status, response.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting comment:', error);
                    })
                    .finally(() => {
                        this.showDeleteModal = false;
                        this.commentToDelete = null;
                    });
            }
        },

        cancelDelete() {
            this.showDeleteModal = false;
            this.commentToDelete = null;
        },

        async deleteComment(id) {
            this.commentToDelete = id;
            this.showDeleteModal = true;
        },

        showRepostModal(comment) {
            this.formReport.comment_id = comment.id;
            this.showReport = true;
        },

        reportComment() {
            this.processing = true;
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
                        this.processing = false;
                    } else {
                        this.errors = response.data.errors
                        console.error('Failed to post report:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error posting report:', error);
                });
        },
        async valideDelete(comment) {
            this.deleting = true;
        }
    }));
});

Alpine.start()
