document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll(".section")
  window.addEventListener("scroll", () => {
    sections.forEach((section) => {
      const sectionTop = section.getBoundingClientRect().top
      const triggerHeight = window.innerHeight * 0.8

      if (sectionTop < triggerHeight) {
        section.classList.add("visible")
      }
    })
  })
  let currentIndex = 0
  const images = document.querySelectorAll(".carousel-images img")
  const totalImages = images.length

  function changeImage() {
    currentIndex = (currentIndex + 1) % totalImages
    document.querySelector(".carousel-images").style.transform = `translateX(-${
      currentIndex * 100
    }%)`
  }

  setInterval(changeImage, 3000) // Ganti gambar setiap 3 detik
})
