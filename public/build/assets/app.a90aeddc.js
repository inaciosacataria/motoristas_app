// HOTFIX: This build artifact is loaded in the browser but was generated as CommonJS.
// Since `require` doesn't exist in the browser, it was throwing and preventing other JS from running.
// Keep as no-op to avoid breaking page features (e.g., TinyMCE init).
