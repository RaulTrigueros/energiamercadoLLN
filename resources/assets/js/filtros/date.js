export default (value) =>{
   const date = new Date(value);
   return date.toLocaleString(['es-ES'], {day: '2-digit',month: '2-digit',year: 'numeric'});
}

