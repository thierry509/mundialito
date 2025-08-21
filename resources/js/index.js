import Alpine from 'alpinejs'
import { apiFetch } from './fetch';
window.Alpine = Alpine



document.addEventListener('alpine:init', () => {
    Alpine.data('comments', ({ type, id, }) => ({
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
        init() {
            this.loadComments()
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
            if (!comment.menuOn) {
                comment.menuOn = true;
            }
            else {
                comment.menuOn = false;
            }
        },
        loadComments() {
            apiFetch(`/${type}/${id}/comments/`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        this.commentsList = response.data;
                    } else {
                        console.error('Failed to load comments:', response.status);
                    }
                }
                ).catch(error => {
                    console.error('Error fetching comments:', error);
                }).finally(() => {
                    this.isLoading = false;
                });
        },
        loadReplies(comment, parent = null) {
            apiFetch(`/comments/${comment.id}/replies`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        if (parent) {
                            console.log(parent.replies)
                            parent.replies = [...parent.replies, ...response.data]
                        }
                        comment.replies = response.data
                        comment.showReplies = true // pour contrôler l'affichage


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
                data: this.form, // <-- utiliser "data" au lieu de "body"
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    // pas besoin de 'Content-Type' si tu passes un FormData,
                    // si c'est un objet JS il sera automatiquement JSON.stringifié
                }
            })
                .then(response => {
                    if (response.ok) {
                        this.loadComments(id);
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
                method: 'DELETE', // majuscules obligatoires
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Comment deleted successfully');
                        this.loadComments(); // recharge la liste si besoin
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
                        console.error('Failed to post comment:', response.status, response.data);
                    }
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });
        },
    }));
});

Alpine.start()


