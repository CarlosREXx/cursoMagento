var config = {
    deps: [
        'js/bootstrap.bundle.min'
    ],
    paths: {
        'functions': 'js/functions',
        'plugins': 'js/plugins.min'
    },
    shim: {
        'functions': {'deps': ['jquery']},
        'plugins.min': {'deps': ['jquery']},
        'js/bootstrap.bundle.min': {'deps': ['jquery']}
    }
};