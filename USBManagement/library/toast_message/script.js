
let toastList = document.querySelector(".toast-list");
let btns = document.querySelectorAll(".btn");

const iconPath = {
    success: "public/assets/icons/check.svg",
    info: "public/assets/icons/info.svg",
    error: "public/assets/icons/error.svg",
    warning: "public/assets/icons/warning.svg",
    close: 'public/assets/icons/cancel.svg'
  };




const createToast = (message, type) => {
  //getting toast details based on button id

  //creating new li tag
  let toast = document.createElement("li");

  //setting class names for li tag created
  toast.className = `toast ${type}`;

  //generating inner html for toast tag
  toast.innerHTML = ` <div class="column">
  <img src="${iconPath[type]}" alt="${type} icon" width="16" height="16" class="icon-type icon-type-${type}"/>
  <span>${message}</span>
</div>

<img src="${iconPath['close']}" alt="Close" class="close-icon" onclick="removeToast(this.parentElement)" width="16" height="16"/>`;

  //appending created toast to toast list
  toastList.appendChild(toast);

  //setting timeout for toast after specified duration
  toast.timeoutId = setTimeout(() => {
    removeToast(toast);
  }, 5000);
};

let removeToast = (toast) => {
  toast.classList.add("hide");

  //clearing timeout for the toast
  if (toast.timeoutId) clearTimeout(toast.timeoutId);

  //removing the toast after 500ms
  setTimeout(() => {
    toast.remove();
  }, 500);
};
