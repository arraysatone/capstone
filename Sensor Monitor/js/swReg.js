/*
*    ArraysAtOne Capstone 2018 - Maple Leaf Foods
*
*    Kevin Baumgartner
*    Jesse Berube
*    Marc Harquail
*    Alex Ireland
*
* * * * * * * * * * * * * * * * * * * * * * * * *
*
*    swReg.js
*    
*    Jesse Berube
*
*/

/*
const applicationServerPublicKey = 'BDdwEBrdYJHza76WnYnP4rWMSELpDXxqgTG1v624Ofk86CjgMfL3wD22ngQjzWFbJdlDU2YCWgeFPn8YPWYvEGY';


let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');

  navigator.serviceWorker.register('sWorker.js')
  .then(function(swReg) {
    console.log('Service Worker is registered', swReg);
    swRegistration = swReg;
	initializeUI();
  })
  .catch(function(error) {
    console.error('Service Worker Error', error);
  });
} else {  	
  console.warn('Push messaging is not supported');
  pushButton.textContent = 'Push Not Supported';
}

function initializeUI() {
  // Set the initial subscription value
  swRegistration.pushManager.getSubscription()
  .then(function(subscription) {
    isSubscribed = !(subscription === null);
    if (isSubscribed) {
      console.log('User IS subscribed.');
    } else {
      console.log('User is NOT subscribed.');
	  subscribeUser();
    }
  });
}


function subscribeUser() {
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  swRegistration.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: applicationServerKey
  })
  .then(function(subscription) {
    console.log('User is subscribed.');

    isSubscribed = true;
	  

  })
  .catch(function(err) {
    console.log('Failed to subscribe the user: ', err);
	
  });
}
*/
