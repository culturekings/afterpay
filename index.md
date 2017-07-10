### Known Issues.

1. Passing in a Money value with more than 2 decimal places will result in an error from Afterpay saying 'The request contains improperly formated JSON'. Issue #33 outlines this problem. This library will not provide rounding or manipulation of values as it's is the responsability of the project to provide accurate values.
