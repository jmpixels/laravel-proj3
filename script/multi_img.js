const multipleImages = document.getElementById('multiple_img');
const imagePreviewContainer = document.getElementById('image-preview');
let selectedFiles = [];

multipleImages.addEventListener('change', function(event) {
    const files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedFiles.push(file);
            const imageContainer = createImageContainer(e.target.result, file);
            imagePreviewContainer.appendChild(imageContainer);
            imagePreviewContainer.classList.add('active');
        };

        reader.readAsDataURL(file);
    }
});

function createImageContainer(imageSrc, file) {
    // Remaining createImageContainer code...


    const imageContainer = document.createElement('div');
    imageContainer.classList.add('image-container');

    const image = document.createElement('img');
    image.src = imageSrc;

    const deleteButton = document.createElement('button');
    deleteButton.innerText = 'Remove Image';
    deleteButton.addEventListener('click', function() {
        imageContainer.remove();
        if (file) {
            if (selectedFiles.length > 0) {
                selectedFiles = [];
                thumbnail.value = ''; // Reset the thumbnail input value
                previewContainer.classList.remove('active'); // Remove thumb_active class
            } else {
                removeFileFromArray(file);
            }
        } else {
            removeFileFromArray(file);
        }
    });

    imageContainer.appendChild(image);
    imageContainer.appendChild(deleteButton);
    return imageContainer;
}

function removeFileFromArray(fileToRemove) {
    // Remaining removeFileFromArray code...


    selectedFiles = selectedFiles.filter(file => file !== fileToRemove);
    updateInputValue();

    const thumb_imageContainers = previewContainer.getElementsByClassName('image-container');
    if (thumb_imageContainers.length === 0 && thumb_selectedFiles.length === 0) {
        previewContainer.classList.remove('active');
    }
}

function updateInputValue() {
    // Remaining updateInputValue code...

    const updatedFileList = new DataTransfer();
    selectedFiles.forEach(file => updatedFileList.items.add(file));

    multipleImages.files = updatedFileList.files;
    if (thumb_selectedFiles.length > 0) {
        thumbnail.files = new DataTransfer().files;
    }

    const thumb_imageContainers = thumb_previewContainer.getElementsByClassName('image-container');
    const imageContainers = imagePreviewContainer.getElementsByClassName('image-container');

    if (thumb_imageContainers.length === 0 && thumb_selectedFiles.length === 0) {
        thumb_previewContainer.classList.remove('thumb_active');
    }

    if (imageContainers.length === 0 && selectedFiles.length === 0) {
        imagePreviewContainer.classList.remove('active');
    }
}
