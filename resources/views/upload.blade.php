@extends('layouts.default')

@section('content')
    <div class="px-3 py-3">
        <div class="container">
            <div class="m-3">
                <h1 class="title text-center">Upload Your Media</h1>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" />
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="userEmailHelp" />
                            <small id="userEmailHelp" class="form-text text-muted">In case we need to contact you. We will never share this.</small>
                        </div>
                        <div class="form-group">
                            <label for="contentDescription">Describe your content</label>
                            <input type="text" class="form-control" id="contentDescription" name="contentDescription" placeholder="e.g., &ldquo;Missions Trip Photos&rdquo;" maxlength="32" />
                        </div>
                    </form>
                    <div id="uploaderHiddenMessage" class="uploader-hidden-message">
                        Upload field will appear once you provide your name, email address and description.
                    </div>
                    <div id="uploaderContainer" class="uploader-container"></div>
                </div>
            </div>
        </div>
        <div class="m-3 text-center">
            <img src="https://s3.amazonaws.com/gcm-my-video-testimony/site-assets/gcm-logo-color-horizontal_trans-bg_594x284.png" alt="Grace Church of Mentor" width="200" />
            <br/>
            <p>
                Questions?
                <a href="https://gracechurchmentor.org/contact">Contact us</a>.
            </p>
        </div>
    </div>

    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Select file(s)</div>
            </div>
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>
    <script>
        var fineUploaderS3Endpoint = "{{ env("S3_ENDPOINT") }}";
        var fineUploaderAWSClientPublicKey = "{{ env("AWS_CLIENT_PUBLIC_KEY") }}";
        var fineUploaderS3BucketRegion = "{{ env("S3_BUCKET_REGION") }}";
        var fineUploaderS3BucketName = "{{ env("S3_BUCKET_NAME") }}";
    </script>
    <script src="{{ mix('js/fineuploader.js') }}"></script>
@endsection
