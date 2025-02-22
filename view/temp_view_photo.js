
const previewImage = (event) => {
  const input = event.target;
  const file = input.files[0];
  const reader = new FileReader();

  reader.onload = function (e) {
    const imagePreview = document.getElementById('imagePreview');
    imagePreview.src = e.target.result;
    imagePreview.style.display = 'block';
  }

  if (file) {
    reader.readAsDataURL(file);
  }
}
