
// $(document).ready(function($) {
//     $.fn.menuAim = function(opts) {
//         // Initialize menu-aim for all elements in jQuery collection
//         this.each(function() {
//             init.call(this, opts);
//         });

//         return this;
//     };

//     function init(opts) {
//         var $menu = $(this),
//             activeRow = null,
//             mouseLocs = [],
//             lastDelayLoc = null,
//             timeoutId = null,
//             options = $.extend({
//                 rowSelector: "> li",
//                 submenuSelector: "*",
//                 submenuDirection: "right",
//                 tolerance: 100,
//                 enter: $.noop,
//                 exit: $.noop,
//                 activate: $.noop,
//                 deactivate: $.noop,
//                 exitMenu: $.noop
//             }, opts);

//         var MOUSE_LOCS_TRACKED = 0, 
//             DELAY = 0; 

//         var mousemoveDocument = function(e) {
//                 mouseLocs.push({x: e.pageX, y: e.pageY});

//                 if (mouseLocs.length > MOUSE_LOCS_TRACKED) {
//                     mouseLocs.shift();
//                 }
//             };

//         var mouseleaveMenu = function() {
//                 if (timeoutId) {
//                     clearTimeout(timeoutId);
//                 }

//                 if (options.exitMenu(this)) {
//                     if (activeRow) {
//                         options.deactivate(activeRow);
//                     }

//                     activeRow = null;
//                 }
//             };

//         var mouseenterRow = function() {
//                 if (timeoutId) {
//                     clearTimeout(timeoutId);
//                 }

//                 options.enter(this);
//                 possiblyActivate(this);
//             },
//             mouseleaveRow = function() {
//                 options.exit(this);
//             };

//         var clickRow = function() {
//                 activate(this);
//             };

//         var activate = function(row) {
//                 if (row == activeRow) {
//                     return;
//                 }

//                 if (activeRow) {
//                     options.deactivate(activeRow);
//                 }

//                 options.activate(row);
//                 activeRow = row;
//             };

//         var possiblyActivate = function(row) {
//                 var delay = activationDelay();

//                 if (delay) {
//                     timeoutId = setTimeout(function() {
//                         possiblyActivate(row);
//                     }, delay);
//                 } else {
//                     activate(row);
//                 }
//             };

//         var activationDelay = function() {
//                 if (!activeRow || !$(activeRow).is(options.submenuSelector)) {
//                     return 0;
//                 }

//                 var offset = $menu.offset(),
//                     upperLeft = {
//                         x: offset.left,
//                         y: offset.top - options.tolerance
//                     },
//                     upperRight = {
//                         x: offset.left + $menu.outerWidth(),
//                         y: upperLeft.y
//                     },
//                     lowerLeft = {
//                         x: offset.left,
//                         y: offset.top + $menu.outerHeight() + options.tolerance
//                     },
//                     lowerRight = {
//                         x: offset.left + $menu.outerWidth(),
//                         y: lowerLeft.y
//                     },
//                     loc = mouseLocs[mouseLocs.length - 1],
//                     prevLoc = mouseLocs[0];

//                 if (!loc) {
//                     return 0;
//                 }

//                 if (!prevLoc) {
//                     prevLoc = loc;
//                 }

//                 if (prevLoc.x < offset.left || prevLoc.x > lowerRight.x ||
//                     prevLoc.y < offset.top || prevLoc.y > lowerRight.y) {
//                     return 0;
//                 }

//                 if (lastDelayLoc &&
//                         loc.x == lastDelayLoc.x && loc.y == lastDelayLoc.y) {
//                     return 0;
//                 }

//                 function slope(a, b) {
//                     return (b.y - a.y) / (b.x - a.x);
//                 };

//                 var decreasingCorner = upperRight,
//                     increasingCorner = lowerRight;

//                 if (options.submenuDirection == "left") {
//                     decreasingCorner = lowerLeft;
//                     increasingCorner = upperLeft;
//                 } else if (options.submenuDirection == "below") {
//                     decreasingCorner = lowerRight;
//                     increasingCorner = lowerLeft;
//                 } else if (options.submenuDirection == "above") {
//                     decreasingCorner = upperLeft;
//                     increasingCorner = upperRight;
//                 }

//                 var decreasingSlope = slope(loc, decreasingCorner),
//                     increasingSlope = slope(loc, increasingCorner),
//                     prevDecreasingSlope = slope(prevLoc, decreasingCorner),
//                     prevIncreasingSlope = slope(prevLoc, increasingCorner);

//                 if (decreasingSlope < prevDecreasingSlope &&
//                         increasingSlope > prevIncreasingSlope) {
                   
//                     lastDelayLoc = loc;
//                     return DELAY;
//                 }

//                 lastDelayLoc = null;
//                 return 0;
//             };

//         $menu
//             .mouseleave(mouseleaveMenu)
//             .find(options.rowSelector)
//                 .mouseenter(mouseenterRow)
//                 .mouseleave(mouseleaveRow)
//                 .click(clickRow);

//         $(document).mousemove(mousemoveDocument);

//     };
// });

