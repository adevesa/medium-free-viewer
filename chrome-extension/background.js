chrome.action.onClicked.addListener((tab) => {
    chrome.scripting.executeScript({
        target: { tabId: tab.id },
        function: moveToFreeViewer,
    });
})

function moveToFreeViewer() {
    const url = window.location.href;
    window.location = `http://medium-free-viewer.herokuapp.com/medium?url=${url}`
}
