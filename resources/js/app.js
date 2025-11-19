import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// For login and register loading
document.addEventListener('alpine:init', () => {
    Alpine.data("formLoading", () => ({
        loading: false,
        start() {
            this.loading = true;
        }
    }));

    Alpine.data("followUnfollow", (initialState) => ({
        isFollowing: initialState.isFollowing,
        followers_count: initialState.followers_count,
        following_count: initialState.following_count,
        loading: false,
        toggleFollow() {
            this.loading = true;

            axios.post(initialState.url)
                .then(response => {
                    this.isFollowing = response.data.isFollowing;
                    this.followers_count = response.data.followers_count;
                    this.following_count = response.data.following_count;
                })
                .catch(err => {
                    console.error(err);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }));
});

Alpine.start();