self.addEventListener('push', function(event) {
  console.log('[Service Worker] Push Received.');

  const title = 'Arrays At One';
  const options = {
    body: 'A Sensor At Arrays At One Is Over The Safe Threshold!!!',
    icon: 'media/maple.png'
  };

  event.waitUntil(self.registration.showNotification(title, options));
});