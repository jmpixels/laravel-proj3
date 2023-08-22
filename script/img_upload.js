let files = [],
    button = document.querySelector('.top button'),
    form = document.querySelector('.upload-form'),
    container = document.querySelector('.container-display'),
    text = document.querySelector('.inner'),
    browse = document.querySelector('.select'),
    input = document.querySelector('.upload-form input');


browse.addEventListener('click', () => input.click());

input.addEventListener('change', () => {
    let file = input.files;




    for (let i = 0; i < file.length; i++) {
        if(files.every(e => e.name != file[i].name)) files.push(file[i])
        
    }

    form.reset();
    showImages();
})

const showImages = () => {
    let images = '';
    files.forEach( (e, i) => {
        images += `<div class="image">
        <img src="${URL.createObjectURL(e)}" alt="image">
        <span onclick = "delImage(${i})">&times;</span>
    </div>`
    });

    container.innerHTML = images;
}

const delImage = index => {
    files.splice(index, 1)
    showImages()
}

form.addEventListener('dragover', e => {
    e.preventDefault();

    form.classList.add('drag-over');
    text.innerHTML = 'Drag & drop image here ';
});

form.addEventListener('dragleave', () => {
    form.classList.remove('drag-over');
    text.innerHTML = 'Drag & drop image here or <span class="select">Browse</span>';
});


form.addEventListener('drop', e =>{
    e.preventDefault()

    form.classList.remove('drag-over');
    text.innerHTML = 'Drag & drop image here or <span class="select">Browse</span>';

    let file = e.dataTransfer.files;
    for (let i = 0; i < file.length; i++) {
        if(files.every(e => e.name != file[i].name)) files.push(file[i])    
    }

    showImages();

})


button.addEventListener('click', () => {
    let form = new FormData();
    files.forEach((e, i) => append(`file[${i}]`, e))
})


