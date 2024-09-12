const menus = document.querySelector("nav ul");
const header = document.querySelector("header");


window.addEventListener("scroll", () => {
  if (document.documentElement.scrollTop > 20) {
    header.classlist.add("sticky");
  } else {
    header.classlist.remove("sticky");
  }
});
const countersEL = document.querySelectorAll(".numbers");
countersEL.forEach((counters) => {
  counters.textContent = 0;

  incrementCounters();

  function incrementCounters() {
    let currentNum = +counters.textContent;
    const dateCeil = counters.getAttribute("date-ceil");

    const increment = dateCeil / 25;

    currentNum = Math.ceil(currentNum + increment);
    if (currentNum < dateCeil) {
      counters.textContent = currentNum;
      setTimeout(incrementCounters, 70);
    } else {
      counters.textContent = dateCeil;
    }
  }
});
