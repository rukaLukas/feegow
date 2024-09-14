const removeMask = value => value != null && value != undefined ? value.replace(/[\.\(\)-\s+]/g, '') : '';

const capitalizeFirstLetter = string => string.charAt(0).toUpperCase() + string.slice(1);

export {
  removeMask,
  capitalizeFirstLetter,
}
