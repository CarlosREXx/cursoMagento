var config = {
    deps: [
        'js/bootstrap.bundle.min',
    ],
    paths: {
        'mfpopup': 'js/magnific-popup.min',
        'flexslider': 'js/flexslider.min',
        'jgestures': 'js/jgestures.min',
        'jquery-ui': 'js/jquery-ui-1.8.20.custom.min',
        'jquery-mouse': 'js/jquery.mousewheel.min',
        'modernizr': 'js/modernizr.2.5.3.min'

    },
    shim: {
        'js/bootstrap.bundle.min': {
             'deps': ['jquery']
         },
         'flexslider': {'deps': ['jquery']},
         'mfpopup': {
            'deps': ['jquery']
         },
         'jgestures': {
            'deps': ['jquery']
         },
         'jquery-ui': {
            'deps': ['jquery']
         },
         'jquery-mouse': {
            'deps': ['jquery']
         },
         'modernizr': {
            'deps': ['jquery']
         }
     }
};