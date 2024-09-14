
 
 const FormatStringDatePTBR = (data) => {
    let [year, month, day] = data.split('-');
    
    const formatedDate = `${day}/${month}/${year}`;
    return formatedDate;
  }
  
//   const getDifferenceInHours = (date1, date2) => {
//     const diffInMs = Math.abs(date2 - date1);
//     return diffInMs / (1000 * 60 * 60);
//   }
  
//   const isValidDate = date => {
//     return (new Date(date) !== "Invalid Date") && !isNaN(new Date(date));
//   }
  
//   const getDaysBetweenDates = (date1, date2) => {
//     const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
//     const diffDays = Math.round(Math.abs((date1 - date2) / oneDay));
//     return diffDays;
//   }
  
//   const isDateGreaterThanToday = date => {
//     const today = new Date();
//     return date > today;
//   }
  
  
  export {
    FormatStringDatePTBR
  }