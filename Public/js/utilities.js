//// Getting Data to PHP via POST ////
export default function toPhp(url, data, callback) {
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    callback(data, null); // Pass data to callback function
  })
  .catch(error => {
    callback(null, error); // Pass error to callback function
  });
}

//// Build PHP Urls ////
export function queryString(...objects) {
  let url_construct = '';
  for (let obj of objects) {
    const key = Object.keys(obj)[0];
    const value = obj[key];
    url_construct += `${key}=${value}&`;
  }
  url_construct = url_construct.slice(0, -1); // Remove the last '&' character
  return url_construct;
}

//// read files ////
export async function readFile(file) {
  try {
    const response = await fetch(file);
    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }
    const text = await response.text();
    return text;
  } catch (error) {
    console.error('There has been a problem with your fetch operation:', error);
    return null;
  }
}

//// Getting text from a file ////
export async function text(file) {
  try {
  const content = await readFile(file)
  return content;
  } catch (error) {
    throw new Error("Error reading file: " + error + ".");
  }
}

//// Getting current date from ICS file ////
export async function parseICalDate(dateString) {
  // Example: DTSTART;TZID=America/New_York:20220101T090000
  const [, tzid, datetime] = dateString.match(/TZID=([^:]+):(.+)/);
  const [datePart, timePart] = datetime.split('T');
  const year = parseInt(datePart.substr(0, 4));
  const month = parseInt(datePart.substr(4, 2)) - 1; // Months are zero-based in JS
  const day = parseInt(datePart.substr(6, 2));
  const hours = parseInt(timePart.substr(0, 2));
  const minutes = parseInt(timePart.substr(2, 2));

  const tzOffset = getTimezoneOffset(tzid);

  const utcDate = new Date(Date.UTC(year, month, day, hours, minutes));
  return utcDate;
}

//// Parsing ICS files ////
export async function parseICS(file) {
  const textData = await text(file);
  const lines = textData.split('\n');
  
  const events = [];
  let currentEvent = null;

  lines.forEach(line => {
    if (line.startsWith('BEGIN:VEVENT')) {
      currentEvent = {};
    } else if (line.startsWith('END:VEVENT')) {
      events.push(currentEvent);
      currentEvent = null;
    } else if (currentEvent) {
      const [key, value] = line.split(/:(.+)/);

      switch (key) {
        case 'SUMMARY':
          currentEvent.summary = value;
          break;
        case 'DTSTART':
          currentEvent.startDate = parseICalDate(value);
          break;
        case 'DTEND':
          currentEvent.endDate = parseICalDate(value);
          break;
        case 'DESCRIPTION':
          currentEvent.teacher = value;
          break;
        case 'LOCATION':
          currentEvent.location = value;
          break;
      }
    }
  });
  console.table(events);
  return events;
}


export const classes = {
  "HuiAko": "HuiAko",
  "INT": "Integrated Studies",
  "INS": "Integrated Studies Neuro-Diverse",
  "ENG": "English",
  "MAT": "Maths",
  "SCI": "Science",
  "AHI": "Aotearoa Histories",
  "HPE": "Health & PE",
  "HEA": "Health & Wellbeing",
  "PEO": "Physical Education Outdoors",
  "PED": "Physical Education",
  "PES": "Sports And Training",
  "TGC": "Coding For Gaming",
  "TDE": "Digital Technologies",
  "DTE": "Digital Technology Environments",
  "TPD": "Product Design And Construction",
  "TBT": "Bio Technology",
  "TDV": "Architecture And Product Design",
  "TFD": "Food Around The World",
  "TTX": "Fashion And Textiles",
  "JDT": "Jewellery And Product Design",
  "CAR": "Carpentry",
  "HOS": "Hospitality",
  "PHT": "Photography",
  "ARP": "Art Painting",
  "ARD": "Art Design",
  "ART": "Visual Art",
  "MUS": "Music",
  "MUJ": "Music Jazz",
  "DAN": "Dance",
  "DRA": "Drama",
  "MPA": "Maori Performing Arts",
  "FSI": "Forensics Science",
  "SFC": "Food Chemistry",
  "SSU": "Space And Us",
  "SNS": "The Nature Of Science",
  "SCB": "Chemistry And Biology",
  "SPS": "Physics And Space Science",
  "BIO": "Biology",
  "CHE": "Chemistry",
  "PHY": "Physics",
  "ELS": "Environmental Life Science",
  "FRE": "French",
  "FRA": "French Advanced",
  "JPN": "Japanese",
  "JPA": "Japanese Advanced",
  "MDR": "Mandarin",
  "MDA": "Mandarin Advanced",
  "MAO": "Maori",
  "MAA": "Maori Advanced",
  "SAM": "Te Kura Samoan",
  "EPS": "English Proficiency Studies",
  "PWR": "Power Of The Word",
  "BUS": "Business Studies",
  "COM": "Commerce Money Talks",
  "COT": "International Travel",
  "GEO": "Geography",
  "HIS": "History",
  "CLS": "Classical Studies",
  "ECC": "Economics",
  "FIN": "Financial Capability",
  "MED": "Media Studies",
  "PSY": "Psychology",
  "TOU": "Tourism",
  "ENGA": "Sport And Society",
  "ENGB": "English And The Environment",
  "ENGC": "Maori And Pacific Voices",
  "ENGD": "Conspiracy Theories",
  "ENGF": "Dystopia",
  "ENGG": "Messages In Music",
  "ENGH": "Modern Mythic",
  "ENGJ": "NZ Culture In Film",
  "ENGK": "It's The Little Things",
  "ENGL": "What Do They Have To Say?",
  "ENGM": "Poetry Power",
  "ENGN": "Maori And Pacific Voices 2",
  "ENGQ": "Wahine Toa",
  "MAC": "Mathematics With Calculus",
  "MAS": "Mathematics With Statistics",
  "GAT": "Pathways Gateway Level",
  "PAT": "Pathways Pathways Level",
  "WTA": "Pathways Wellington Trades Academy",
  "SPEC": "Learning Support - SPEC",
  "LST": "Learning Support Transition"
};