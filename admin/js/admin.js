const copyToClipboard = (shortcode) => {
  if (navigator && navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(shortcode);
    tooltip.innerHTML = "انجام شد!";
  }
  return Promise.reject("The Clipboard API is not available.");
};
const tooltip = document.getElementById("myTooltip");
const clipboard = document.querySelector(
  ".dwpc-shortcode .dashicons-clipboard"
);
const shortcodeText = document
  .querySelector(".dwpc-shortcode p > strong ")
  .textContent.trim();

clipboard.addEventListener("click", () => copyToClipboard(shortcodeText));
