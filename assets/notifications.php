<div id="notification-container"></div>
<script>
    var notification;
    var container = document.querySelector('#notification-container');
    var visible = false;
    var queue = [];

    function createNotification() {
        notification = document.createElement('div');
        var btn = document.createElement('button');
        btn.innerText = "ok"
        var title = document.createElement('div');
        var msg = document.createElement('div');
        btn.className = 'notification-close';
        title.className = 'notification-title';
        msg.className = 'notification-message';
        //setTimeout(hideNotification, 3)
        btn.addEventListener('click', hideNotification, false);
        notification.addEventListener('animationend', hideNotification, false);
        notification.addEventListener('webkitAnimationEnd', hideNotification, false);

        notification.appendChild(title);
        notification.appendChild(msg);
        notification.appendChild(btn);
    }
    function updateNotification(type, title, message) {
        notification.className = 'notification notification-' + type;
        notification.querySelector('.notification-title').innerHTML = title;
        notification.querySelector('.notification-message').innerHTML = message;
    }

    function showNotification(type, title, message) {
        if (visible) {
            queue.push([type, title, message]);
            return;
        }
        if (!notification) {
            createNotification();
        }
        updateNotification(type, title, message);
        container.appendChild(notification);
        visible = true;
    }

    function hideNotification() {
        if (visible) {
            visible = false;
            container.removeChild(notification);
            if (queue.length) {
                showNotification.apply(null, queue.shift());
            }
        }
    }
</script>