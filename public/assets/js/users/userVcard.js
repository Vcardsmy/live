/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/users/userVcard.js ***!
  \************************************************/
document.addEventListener('DOMContentLoaded', loadUserVcardTable);
var userVcardTable = '#userVcardTable';

function loadUserVcardTable() {
  if (!$('#userVcardTable').length) {
    return;
  }

  var userVcard = $(userVcardTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('users.show', id)
    },
    columnDefs: [{
      'targets': [1, 2],
      'className': 'text-nowrap'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex\">\n                                <div class=\"symbol me-5\">\n                                   <img src=\"".concat(isEmpty(row.template) ? defaultTemplate : row.template.template_url, "\" alt=\"\" class=\"w-60\">\n                                </div>\n                                <div class=\"d-flex align-items-center\">\n                                    ").concat(row.name, "\n                                </div>\n                            </div>");
      },
      name: 'name'
    }, {
      data: 'occupation',
      name: 'occupation'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'status': row.status,
          'vcardViewUrl': route('vcard.defaultIndex') + '/' + row.url_alias
        }];
        return prepareTemplateRender('#vcardActionTemplate', data);
      },
      name: 'url_alias'
    }, {
      data: function data(row) {
        if (row.status == 1) {
          return '<span class="badge bg-success">Active</span>';
        } else {
          return '<span class="badge bg-danger">Deactivate</span>';
        }
      },
      name: 'status'
    }]
  });
}
/******/ })()
;