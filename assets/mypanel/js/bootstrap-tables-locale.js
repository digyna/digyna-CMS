(function ($) {
    'use strict';

    $.fn.bootstrapTable.locales[lang.code] = {
		formatLoadingMessage: function () {
			return lang.line('tables_loading');
		},
		formatRecordsPerPage: function (pageNumber) {
			return lang.line('tables_rows_per_page').replace('{0}', pageNumber);
		},
		formatShowingRows: function (pageFrom, pageTo, totalRows) {
			return lang.line('tables_page_from_to').replace('{0}', pageFrom).replace('{1}', pageTo).replace('{2}', totalRows);
		},
		formatSearch: function () {
			return lang.line('common_search');
		},
		formatNoMatches: function () {
			return lang.line($controller_name.match('(customers|users)') ? 'common_no_persons_to_display' : $controller_name + '_no_' + $controller_name +'_to_display');
		},
		formatPaginationSwitch: function () {
			return lang.line('tables_hide_show_pagination');
		},
		formatRefresh: function () {
			return lang.line('tables_refresh');
		},
		formatToggle: function () {
			return lang.line('tables_toggle');
		},
		formatColumns: function () {
			return lang.line('tables_columns');
		},
		formatAllRows: function () {
			return lang.line('tables_all');
		}
    };

    $.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales[lang.code]);

})(jQuery);