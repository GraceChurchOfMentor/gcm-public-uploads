var qq = require('fine-uploader/lib/s3');

const uploader = new qq.s3.FineUploader({
    element: document.getElementById("uploaderContainer"),
    debug: false,
    request: {
        endpoint: "https://gcm-my-video-testimony.s3.amazonaws.com",
        accessKey: "AKIAIE3JHWO6DPCNSFUA"
    },
    signature: {
        endpoint: "/s3/sign"
    },
    uploadSuccess: {
        endpoint: "/s3/success"
    },
    iframeSupport: {
        localBlankPagePath: "/blank"
    },
    chunking: {
        enabled: true,
        concurrent: {
            enabled: true
        }
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    validation: {
        allowedExtensions: [
            'mp4',
            'mov',
            'avi',
            'mpg',
            'mpeg',
            'm4v',
            'wmv',
            'webm',
            'mkv',
            'flv',
            'vob',
            'ogg',
            'ogv',
            '3gp'
        ]
    },
    deleteFile: {
        enabled: false,
        endpoint: "/s3"
    }
});
