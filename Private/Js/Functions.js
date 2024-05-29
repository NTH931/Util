

//--------------------------------------Const Variables---------------------------------------//

/*
const (variables) = function () {
  Code snippet
}
*/

// Go backwards Once
export const historyBack = function() {
  history.back()
};

// Go Forwards Once
export const historyFwd = function() {
  history.forward()
};
//------------------------------------------While Loops---------------------------------------//

//--------------------------------------Normal Variables--------------------------------------//
export function logData() {
  var data = {
      timestamp: new Date().toISOString(),
      userAgent: navigator.userAgent,
      screenWidth: screen.width,
      screenHeight: screen.height,
      // Add more data as needed
  };

  fetch('/Private/Functions/log.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.error('Error logging data:', error));
}


export function goBack() {
  historyBack()
}

// Timeout
export function timeout(_time) {
  setTimeout(goBack, _time);
}

export function URL_build(...arrays) {
  let url_construct = '';
  for(let array of arrays) {
    url_construct += array.join('=') + '&';
  }
  url_construct = url_construct.slice(0, -1); // Remove the last '&' character
  return url_construct;
}