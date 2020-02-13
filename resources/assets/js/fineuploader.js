var qq = require('fine-uploader/lib/s3');
var axios = require('axios').default;

var userNameElement = document.querySelector("#userName");
var userEmailElement = document.querySelector("#userEmail");
var contentDescriptionElement = document.querySelector("#contentDescription");

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
    if ( ! contentDescription.value) {
        return false;
    }

    return true;
}

function onFormChange() {
    if (validateUserData()) {
        document.querySelector("#uploaderContainer").classList.remove("hide");
        document.querySelector("#uploaderHiddenMessage").classList.remove("show");
    } else {
        document.querySelector("#uploaderContainer").classList.add("hide");
        document.querySelector("#uploaderHiddenMessage").classList.add("show");
    }
}

onFormChange();

document.querySelectorAll("form input").forEach(function(el){
    el.addEventListener("change", onFormChange);
    el.addEventListener("keyup", onFormChange);
});

const uploader = new qq.s3.FineUploader({
    element: document.querySelector("#uploaderContainer"),
    debug: false,
    request: {
        endpoint: fineUploaderS3Endpoint,
        accessKey: fineUploaderAWSClientPublicKey,
        params: {
            test: true
        }
    },
    signature: {
        endpoint: "/s3/sign",
        version: 4,
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
    /*
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
            '3gp',
            'jpg',
            'png',
            'bmp',
            'gif',
            'zip',
            'pdf',
            'doc',
        ]
    },
    */
    objectProperties: {
        bucket: fineUploaderS3BucketName,
        region: fineUploaderS3BucketRegion,
        key: function(fileId) {
            var userName = userNameElement.value,
                userEmail = userEmailElement.value,
                contentDescription = contentDescriptionElement.value,
                datetime = (new Date()).toISOString(),
                filename = uploader.getName(fileId);

            var key = `${userName}/${contentDescription}/${datetime}_${fileId}_${filename}`

            return key;
        },
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
        },
        onAllComplete: function(succeeded, failed) {
            axios.post('/notify/email', {
                'userName': userNameElement.value,
                'userEmail': userEmailElement.value,
                'folderName': contentDescriptionElement.value,
                'fileCount': succeeded.length,
            });
        }
    }
});
