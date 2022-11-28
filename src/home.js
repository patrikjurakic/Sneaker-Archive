const modalBtn = document.querySelector(".modal-btn");
const overlay = document.querySelector(".modal-overlay");
const closeBtn = document.querySelector(".close-btn");

const navToggle = document.querySelector(".nav-toggle");
const links = document.querySelector(".links");

const btns = document.querySelectorAll(".tab-btn");
const about = document.querySelector(".about");
const articles = document.querySelectorAll(".content");

navToggle.addEventListener("click", function(){
  links.classList.toggle("show-links");
  navToggle.classList.toggle("rotate");
})

modalBtn.addEventListener("click", function(){
  overlay.classList.toggle("open-modal");
})
closeBtn.addEventListener("click", function(){
  overlay.classList.toggle("open-modal");
})

about.addEventListener("click", function(e){
  const id = e.target.dataset.id;
  if(id){
    //remove active from other buttons
    btns.forEach(function(btn){
      btn.classList.remove("active");
      e.target.classList.add("active");
    });
    //hide other
    articles.forEach(function(article){
      article.classList.remove("active");
    });
    const element = document.getElementById(id);
    element.classList.add("active");
  }
});



favbtn = document.getElementById("like");
favbtn.addEventListener("click", function(){
  favbtn.classList.toggle("fav-toggle");
});
