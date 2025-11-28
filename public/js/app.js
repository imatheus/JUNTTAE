// Static JS (no Vite)
// Expect axios and Alpine to be available globally via CDN.

if (window.axios) {
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  const token = document.querySelector('meta[name="csrf-token"]');
  if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
  }
}

if (window.Alpine) {
  window.Alpine.start();
}
