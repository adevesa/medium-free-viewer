let freeReadButton = document.getElementById("free-read");

freeReadButton.addEventListener("click", async () => {
  let [tab] = await chrome.tabs.query({ active: true, currentWindow: true });

  chrome.scripting.executeScript({
    target: { tabId: tab.id },
    function: moveToFreeViewer,
  });
});

function moveToFreeViewer() {
  const url = window.location.href;
  window.location = `http://medium-free-viewer.herokuapp.com/medium?url=${url}`
}
