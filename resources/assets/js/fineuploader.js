var qq = require('fine-uploader/lib/s3');

var userNameElement = document.querySelector("#userName");
var userEmailElement = document.querySelector("#userEmail");

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateUserData() {
    if ( ! userNameElement.value) {
        return false;
    }
    if ( ! validateEmail(userEmailElement.value)) {
        return false;
    }
    return true;
}

function onFormChange() {
    if (validateUserData()) {
        document.getElementById("uploaderContainer").classList.remove("hide");
    } else {
        document.getElementById("uploaderContainer").classList.add("hide");
    }
}

onFormChange();

userNameElement.addEventListener("change", onFormChange);
userEmailElement.addEventListener("change", onFormChange);
userNameElement.addEventListener("keyup", onFormChange);
userEmailElement.addEventListener("keyup", onFormChange);

const uploader = new qq.s3.FineUploader({
    element: document.getElementById("uploaderContainer"),
    debug: false,
    request: {
        endpoint: "https://gcm-my-video-testimony.s3.amazonaws.com",
        accessKey: "AKIAIE3JHWO6DPCNSFUA",
        params: {
            test: true
        }
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
    },
    callbacks: {
        onSubmit: function(id, name) {
            if ( ! validateUserData()) {
                alert("Please provide your name and email address.");
                return false;
            }
            this.setParams({
                name: userNameElement.value,
                email: userEmailElement.value
            });
        }
    }
});
