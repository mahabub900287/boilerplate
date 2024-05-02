
const triggerNotify = (status, message) => {
    iziToast[status]({
        message: message,
        position: "bottomLeft",
    });
triggerArrayNotify}
const triggerArrayNotify = (messages, status = 'error') => {
    console.log(messages);
    messages.forEach(message => {
        triggerNotify(status, message);
    });
}
