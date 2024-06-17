class Xml {
  private xhttp: XMLHttpRequest;
  private file: string;
  public constructor(file: string) {
    this.xhttp = new XMLHttpRequest();
    this.file = file;
  }

  public php(method: string, data: any, element: string): void  {
    const xhttp = this.xhttp;
    xhttp.open(method.toUpperCase(), this.file, true);
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.onreadystatechange = function(e) {
      if (xhttp.readyState === 4 && xhttp.status === 200) {
        const json = JSON.parse(xhttp.responseText);
        console.log(json);
        if (typeof element === "string") {
          document.getElementById(element)!.innerText = JSON.stringify(json, null, 2);
        }
      }
    };

    if (data !== "") {
      xhttp.send(data);
    } else {
      throw new Error("No data to send. Exiting with status code")
    }
  }
}