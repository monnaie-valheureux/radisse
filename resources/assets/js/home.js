document.addEventListener("DOMContentLoaded", function(event) {

  /**
   * Randomly select the series of bills that will be displayed.
   *
   * This small script randomly selects a region among the existing ones.
   * It then adds a class with this region’s name on the <body> element,
   * thus causing the bills of that region to be displayed in the shape
   * of a fan in the header of the home page.
   */

  // Abort if `Element.classList` is not supported. The bills
  // from the ‘liege’ region will be displayed as a fallback.
  if (('classList' in document.body) === false) {
    return;
  }

  const regions =
    [
        'herve',
        'huy-hesbaye-condroz',
        'liege',
        'ourthe-ambleve',
        'verviers',
    ];

  // Get a random integer between 0 and 4.
  const i = Math.floor(Math.random() * 5);

  document.body.classList.add('region-'+regions[i]);

});
