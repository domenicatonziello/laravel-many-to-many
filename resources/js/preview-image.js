// prendo elementi
const image = document.getElementById('image');
const preview = document.getElementById('preview');

image.addEventListener('change', () => {
    if (image.files && image.files[0]) {
        const reader = new FileReader();
        reader.readAsDataURL(image.files[0]);

        reader.addEventListener('load', (e) => {
            preview.src = e.target.result;
        });
    }
    else {
        preview.src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToAJWzwYiDV9a5AvKOyHpeBXgjj-K_8i_WnVmIQSBmJAYa2NATl--M6dAVolBJibkV0do&usqp=CAU';
    }
});