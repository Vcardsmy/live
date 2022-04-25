/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/features/features.js ***!
  \**************************************************/
document.addEventListener('DOMContentLoaded', loadFeaturesTable);
var featuresTable = '#featuresTable';

function loadFeaturesTable() {
  if (!$(featuresTable).length) {
    return;
  }

  var featuresTbl = $(featuresTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[0, 'asc']],
    ajax: {
      url: route('features.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '15%'
    }, {
      'targets': [1],
      'width': '10%',
      'searchble': false,
      'orderable': false
    }, {
      'targets': [2],
      'width': '40%'
    }, {
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        return "<div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                                <a href=\"javascript:void(0)\">\n                                    <div class=\"symbol-label cursor-default\">\n                                        <img src=\"".concat(row.profile_image, "\" alt=\"\"\n                                             class=\"w-100\">\n                                    </div>\n                                </a>\n                            </div>\n                            ");
      },
      name: 'image'
    }, {
      data: 'description',
      name: 'description'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('features.edit', row.id)
        }];

        if (row.is_default === 1) {
          return '';
        } else {
          return prepareTemplateRender('#featuresTemplate', data);
        }
      },
      name: 'id'
    }]
  }); // handleSearchDatatable(featuresTbl);
}
/******/ })()
;