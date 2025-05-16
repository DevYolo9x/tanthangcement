@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
    <style>
        /* select2 custom */
        .select2-container {
            display: block;
            width: 100% !important;
        }
        button.select2-selection__clear {
            display: none;
        }
        .opacity-0 {
            opacity: 0;
        }
        .select2-container .select2-selection--single {
            height: 44px;
            background-color: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 15px;
            line-height: 22px;
            font-weight: 500;
            height: 45px;
            padding: 9px 36px 9px 16px;
            color: #132432;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            background-position: center;
            background-repeat: no-repeat;
            width: 20px;
            height: 20px;
            right: 16px;
            top: 50%;
            margin-top: -10px;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTMuNTMzODkgNi40NTQ5MkMzLjc3NzM5IDYuMjA2NTMgNC4xNTg0MyA2LjE4Mzk1IDQuNDI2OTQgNi4zODcxOEw0LjUwMzg2IDYuNDU0OTJMOS45OTk2NyAxMi4wNjEyTDE1LjQ5NTUgNi40NTQ5MkMxNS43MzkgNi4yMDY1MyAxNi4xMiA2LjE4Mzk1IDE2LjM4ODUgNi4zODcxOEwxNi40NjU1IDYuNDU0OTJDMTYuNzA5IDYuNzAzMyAxNi43MzExIDcuMDkxOTggMTYuNTMxOSA3LjM2NTg3TDE2LjQ2NTUgNy40NDQzNEwxMC40ODQ3IDEzLjU0NTFDMTAuMjQxMiAxMy43OTM1IDkuODYwMTIgMTMuODE2IDkuNTkxNjIgMTMuNjEyOEw5LjUxNDY5IDEzLjU0NTFMMy41MzM4OSA3LjQ0NDM0QzMuMjY2MDUgNy4xNzExMiAzLjI2NjA1IDYuNzI4MTQgMy41MzM4OSA2LjQ1NDkyWiIgZmlsbD0iIzUzNEU1NiIvPgo8L3N2Zz4K);
            background-color: transparent;
            border: none;
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            display: none;
        }

        .modal-login .select2-container .select2-selection--single,
        .modal-account-information .select2-container .select2-selection--single {
            background-color: #F5F5F5;
            border-color: #F5F5F5;
        }

        .select2-container.select2-container--open .select2-selection--single {
            border-color: var(--primary-color);
        }

        .select2-container.select2-container--open .select2-selection--single .select2-selection__arrow {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2LjQ2NjQgMTMuNTQ1MUMxNi4yMjI5IDEzLjc5MzUgMTUuODQxOSAxMy44MTYgMTUuNTczNCAxMy42MTI4TDE1LjQ5NjUgMTMuNTQ1MUwxMC4wMDA3IDcuOTM4ODJMNC41MDQ4NCAxMy41NDUxQzQuMjYxMzQgMTMuNzkzNSAzLjg4MDMgMTMuODE2IDMuNjExOCAxMy42MTI4TDMuNTM0ODcgMTMuNTQ1MUMzLjI5MTM3IDEzLjI5NjcgMy4yNjkyNCAxMi45MDggMy40Njg0NiAxMi42MzQxTDMuNTM0ODcgMTIuNTU1N0w5LjUxNTY3IDYuNDU0OTJDOS43NTkxNyA2LjIwNjUzIDEwLjE0MDIgNi4xODM5NSAxMC40MDg3IDYuMzg3MThMMTAuNDg1NiA2LjQ1NDkyTDE2LjQ2NjQgMTIuNTU1N0MxNi43MzQzIDEyLjgyODkgMTYuNzM0MyAxMy4yNzE5IDE2LjQ2NjQgMTMuNTQ1MVoiIGZpbGw9IiMxRDkzRTMiLz4KPC9zdmc+Cg==);
        }

        .select2-container.select2-container--default.select2-container--open.select2-container--below .select2-selection--single,
        .select2-container.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }

        .select2-results__option {
            background-color: transparent;
            padding: 8px 35px 8px 8px;
            color: #534E56;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            margin: 0;
            background-position: right 8px top 8px;
            background-repeat: no-repeat;
        }

        .select2-results__option.select2-results__option--highlighted {
            color: var(--primary-color);
            background-color: transparent;
        }

        .select2-results__option.select2-results__option--selected {
            color: var(--primary-color);
            background-color: transparent;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0yMC41MzAzIDYuNDY5NjdDMjAuODIzMiA2Ljc2MjU2IDIwLjgyMzIgNy4yMzc0NCAyMC41MzAzIDcuNTMwMzNMMTAuNTMwMyAxNy41MzAzQzEwLjIzNzQgMTcuODIzMiA5Ljc2MjU2IDE3LjgyMzIgOS40Njk2NyAxNy41MzAzTDQuNDY5NjcgMTIuNTMwM0M0LjE3Njc4IDEyLjIzNzQgNC4xNzY3OCAxMS43NjI2IDQuNDY5NjcgMTEuNDY5N0M0Ljc2MjU2IDExLjE3NjggNS4yMzc0NCAxMS4xNzY4IDUuNTMwMzMgMTEuNDY5N0wxMCAxNS45MzkzTDE5LjQ2OTcgNi40Njk2N0MxOS43NjI2IDYuMTc2NzggMjAuMjM3NCA2LjE3Njc4IDIwLjUzMDMgNi40Njk2N1oiIGZpbGw9IiMxRDkzRTMiLz4KPC9zdmc+Cg==);
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            color: var(--primary-color);
            background-color: transparent;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] {
            padding: 8px 0;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option {
            color: #0F1F38;
            font-weight: normal;
            font-size: 14px;
            line-height: 18px;
            padding: 7px 7px 7px 44px;
            position: relative;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option:before {
            content: "";
            width: 16px;
            height: 16px;
            display: block;
            border: 1px solid #0F1F38;
            border-radius: 4px;
            position: absolute;
            top: 8px;
            left: 16px;
            background-position: center;
            background-repeat: no-repeat;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option--highlighted[aria-selected] {
            background-color: #F7F7F7;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option2[aria-selected=true],
        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option--selected {
            color: #0F1F38;
            background-color: transparent;
        }

        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option2[aria-selected=true]:before,
        .select2-container .select2-results__options[aria-multiselectable=true] .select2-results__option--selected:before {
            background-color: #D71925;
            border-color: #D71925;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAiIGhlaWdodD0iOCIgdmlld0JveD0iMCAwIDEwIDgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik05Ljc5OTk1IDEuMTM2TDguNjcxOTUgLTYuMTAzNTJlLTA4TDMuMzk5OTUgNS4yNzJMMS4zMzU5NSAzLjIxNkwwLjE5OTk1MSA0LjM0NEwzLjM5OTk1IDcuNTM2TDkuNzk5OTUgMS4xMzZaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K);
        }

        .select2-container .select2-dropdown {
            background-color: #FFFFFF;
            border: none;
            -webkit-box-shadow: -3px 6px 25px rgba(0, 0, 0, 0.1);
            box-shadow: -3px 6px 25px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            margin-top: 4px;
            padding: 8px;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 50px;
            height: 50px;
            border: 1px solid #DEDFE0;
            border-radius: 6px !important;
            padding: 15px 30px 15px 16px;
            cursor: pointer;
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTExLjMzMzUgNy4xMTM3OEMxMS4yMDg2IDYuOTg5NjIgMTEuMDM5NiA2LjkxOTkyIDEwLjg2MzUgNi45MTk5MkMxMC42ODczIDYuOTE5OTIgMTAuNTE4NCA2Ljk4OTYyIDEwLjM5MzUgNy4xMTM3OEw4LjAwMDEzIDkuNDczNzhMNS42NDAxMyA3LjExMzc4QzUuNTE1MjIgNi45ODk2MiA1LjM0NjI1IDYuOTE5OTIgNS4xNzAxMyA2LjkxOTkyQzQuOTk0IDYuOTE5OTIgNC44MjUwNCA2Ljk4OTYyIDQuNzAwMTMgNy4xMTM3OEM0LjYzNzY0IDcuMTc1NzYgNC41ODgwNSA3LjI0OTQ5IDQuNTU0MiA3LjMzMDczQzQuNTIwMzYgNy40MTE5NyA0LjUwMjkzIDcuNDk5MTEgNC41MDI5MyA3LjU4NzEyQzQuNTAyOTMgNy42NzUxMiA0LjUyMDM2IDcuNzYyMjYgNC41NTQyIDcuODQzNUM0LjU4ODA1IDcuOTI0NzQgNC42Mzc2NCA3Ljk5ODQ4IDQuNzAwMTMgOC4wNjA0NUw3LjUyNjc5IDEwLjg4NzFDNy41ODg3NyAxMC45NDk2IDcuNjYyNSAxMC45OTkyIDcuNzQzNzQgMTEuMDMzQzcuODI0OTggMTEuMDY2OSA3LjkxMjEyIDExLjA4NDMgOC4wMDAxMyAxMS4wODQzQzguMDg4MTQgMTEuMDg0MyA4LjE3NTI3IDExLjA2NjkgOC4yNTY1MSAxMS4wMzNDOC4zMzc3NSAxMC45OTkyIDguNDExNDkgMTAuOTQ5NiA4LjQ3MzQ2IDEwLjg4NzFMMTEuMzMzNSA4LjA2MDQ1QzExLjM5NTkgNy45OTg0OCAxMS40NDU1IDcuOTI0NzQgMTEuNDc5NCA3Ljg0MzVDMTEuNTEzMiA3Ljc2MjI2IDExLjUzMDcgNy42NzUxMiAxMS41MzA3IDcuNTg3MTJDMTEuNTMwNyA3LjQ5OTExIDExLjUxMzIgNy40MTE5NyAxMS40Nzk0IDcuMzMwNzNDMTEuNDQ1NSA3LjI0OTQ5IDExLjM5NTkgNy4xNzU3NiAxMS4zMzM1IDcuMTEzNzhaIiBmaWxsPSIjMEYxRjM4Ii8+Cjwvc3ZnPgo=);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 0;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -webkit-flex-wrap: nowrap;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            margin: 0;
            overflow: hidden;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            padding: 0;
            margin: 0;
            color: #0F1F38;
            font-weight: normal;
            font-size: 16px;
            line-height: 18px;
            background-color: transparent;
            border-radius: 0;
            height: 18px;
            border: none;
            display: inline;
            overflow: visible;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice+li:before {
            content: ',';
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
            display: none;
        }

        .select2-container--default .select2-selection--multiple .select2-search {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
        }

        .select2-container--default .select2-selection--multiple .select2-search .select2-search__field {
            height: 100%;
            width: 100%;
            margin: 0;
            font-weight: normal;
            font-size: 16px;
            line-height: 18px;
            padding: 15px 25px 15px 16px;
            color: #0F1F38;
            font-family: 'Open Sans', sans-serif;
            cursor: pointer;
        }

        .select2-container--default .select2-selection--multiple .select2-search .select2-search__field::-moz-placeholder {
            color: #0f1f38;
            opacity: 1;
        }

        .select2-container--default .select2-selection--multiple .select2-search .select2-search__field:-ms-input-placeholder {
            color: #0f1f38;
        }

        .select2-container--default .select2-selection--multiple .select2-search .select2-search__field::-webkit-input-placeholder {
            color: #0f1f38;
        }

        @media (max-width: 767px) {
            .select2-container--default .select2-selection--multiple {
                min-height: 44px;
                height: 44px;
                padding-top: 12px;
                padding-bottom: 12px;
            }

            .select2-container--default .select2-selection--multiple .select2-search .select2-search__field {
                padding-top: 12px;
                padding-bottom: 12px;
            }
        }

        .select2-container--default.select2-container--open .select2-selection--multiple {
            border: 1px solid #D71925;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            height: 40px;
            background-color: #F2F3F7;
            border: 1px solid #F2F3F7 !important;
            border-radius: 6px;
            font-size: 14px;
            font-weight: normal;
            line-height: 18px;
            padding: 10px 16px;
            padding-right: 35px;
            background-position: right 16px center;
            background-repeat: no-repeat;
            -webkit-box-shadow: none;
            box-shadow: none;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAxOCAxOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2LjI4MjUgMTUuMjE3NkwxMy41IDEyLjQ1NzZDMTQuNTgwMSAxMS4xMTA5IDE1LjEwMzIgOS40MDE1MiAxNC45NjE3IDcuNjgxMDNDMTQuODIwMSA1Ljk2MDUzIDE0LjAyNDggNC4zNTk2NCAxMi43MzkyIDMuMjA3NTNDMTEuNDUzNiAyLjA1NTQzIDkuNzc1NCAxLjQzOTY4IDguMDQ5NzQgMS40ODY5QzYuMzI0MDggMS41MzQxMiA0LjY4MjA5IDIuMjQwNzIgMy40NjE0MSAzLjQ2MTQxQzIuMjQwNzIgNC42ODIwOSAxLjUzNDEyIDYuMzI0MDggMS40ODY5IDguMDQ5NzRDMS40Mzk2OCA5Ljc3NTQxIDIuMDU1NDMgMTEuNDUzNiAzLjIwNzUzIDEyLjczOTJDNC4zNTk2NCAxNC4wMjQ4IDUuOTYwNTMgMTQuODIwMSA3LjY4MTAyIDE0Ljk2MTdDOS40MDE1MiAxNS4xMDMyIDExLjExMDkgMTQuNTgwMSAxMi40NTc2IDEzLjUwMDFMMTUuMjE3NiAxNi4yNjAxQzE1LjI4NzMgMTYuMzMwMyAxNS4zNzAyIDE2LjM4NjEgMTUuNDYxNiAxNi40MjQyQzE1LjU1MyAxNi40NjIzIDE1LjY1MSAxNi40ODE5IDE1Ljc1IDE2LjQ4MTlDMTUuODQ5MSAxNi40ODE5IDE1Ljk0NzEgMTYuNDYyMyAxNi4wMzg1IDE2LjQyNDJDMTYuMTI5OSAxNi4zODYxIDE2LjIxMjggMTYuMzMwMyAxNi4yODI1IDE2LjI2MDFDMTYuNDE3NyAxNi4xMjAyIDE2LjQ5MzMgMTUuOTMzMyAxNi40OTMzIDE1LjczODhDMTYuNDkzMyAxNS41NDQzIDE2LjQxNzcgMTUuMzU3NCAxNi4yODI1IDE1LjIxNzZaTTguMjUwMDUgMTMuNTAwMUM3LjIxMTcgMTMuNTAwMSA2LjE5NjY2IDEzLjE5MjEgNS4zMzMzMSAxMi42MTUzQzQuNDY5OTUgMTIuMDM4NCAzLjc5NzA0IDExLjIxODUgMy4zOTk2OCAxMC4yNTkxQzMuMDAyMzIgOS4yOTk4MyAyLjg5ODM2IDguMjQ0MjMgMy4xMDA5MyA3LjIyNTgzQzMuMzAzNSA2LjIwNzQzIDMuODAzNTEgNS4yNzE5NyA0LjUzNzc0IDQuNTM3NzRDNS4yNzE5NyAzLjgwMzUxIDYuMjA3NDMgMy4zMDM1IDcuMjI1ODMgMy4xMDA5M0M4LjI0NDIzIDIuODk4MzYgOS4yOTk4MyAzLjAwMjMyIDEwLjI1OTEgMy4zOTk2OEMxMS4yMTg1IDMuNzk3MDQgMTIuMDM4NCA0LjQ2OTk1IDEyLjYxNTMgNS4zMzMzMUMxMy4xOTIxIDYuMTk2NjYgMTMuNSA3LjIxMTcgMTMuNSA4LjI1MDA1QzEzLjUgOS42NDI0NCAxMi45NDY5IDEwLjk3NzggMTEuOTYyNCAxMS45NjI0QzEwLjk3NzggMTIuOTQ2OSA5LjY0MjQ0IDEzLjUwMDEgOC4yNTAwNSAxMy41MDAxWiIgZmlsbD0iIzU1NjE3NCIvPgo8L3N2Zz4K);
            box-shadow: none !important;
            outline: none !important;
        }

        .select2-container--default .select2-search--dropdown {
            padding: 7px;
        }

        /* select2 custom */
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999999;
        }

        .form-control.date {
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMy42ODIyIDIuMTY5NUMxMy42NDQgMS44ODU3MiAxMy40MDI2IDEuNjY2OTkgMTMuMTEwNSAxLjY2Njk5QzEyLjc5MTkgMS42NjY5OSAxMi41MzM2IDEuOTI3MjkgMTIuNTMzNiAyLjI0ODM5VjIuODkxMThMNy40NzM0NSAyLjg5MTE4VjIuMjQ4MzlMNy40NjgxOCAyLjE2OTVDNy40Mjk5OCAxLjg4NTcyIDcuMTg4NiAxLjY2Njk5IDYuODk2NTMgMS42NjY5OUM2LjU3NzkgMS42NjY5OSA2LjMxOTYxIDEuOTI3MjkgNi4zMTk2MSAyLjI0ODM5VjIuOTA1NjFDMy45NTU0NiAzLjA2ODQ0IDIuNSA0LjYwMDI2IDIuNSA3LjA3MTgyTDIuNSAxNC4wODdDMi41IDE2LjczOTcgNC4xMzE5NSAxOC4zMzM3IDYuNzQ2ODggMTguMzMzN0gxMy4yNTNDMTUuODcxMSAxOC4zMzM3IDE3LjQ5OTkgMTYuNzY2NCAxNy40OTk5IDE0LjE0NTdWNy4wNzE4MkMxNy41MDc1IDQuNTk5MzggMTYuMDU2NyAzLjA2Nzk4IDEzLjY4NzQgMi45MDU1NFYyLjI0ODM5TDEzLjY4MjIgMi4xNjk1Wk0xMi41MzM2IDQuMDUzOTdWNC43OTkzOEwxMi41Mzg5IDQuODc4MjdDMTIuNTc3MSA1LjE2MjA1IDEyLjgxODQgNS4zODA3OCAxMy4xMTA1IDUuMzgwNzhDMTMuNDI5MSA1LjM4MDc4IDEzLjY4NzQgNS4xMjA0OCAxMy42ODc0IDQuNzk5MzhWNC4wNzExNUMxNS40MTEyIDQuMjE0NTcgMTYuMzUxNiA1LjI1MjYxIDE2LjM0NjEgNy4wNzAwM1Y3LjQwNjczTDMuNjUzODQgNy40MDY3M1Y3LjA3MTgyQzMuNjUzODQgNS4yNTU1NCA0LjU5OTM4IDQuMjE1MzEgNi4zMTk2MSA0LjA3MTI3VjQuNzk5MzhMNi4zMjQ4NyA0Ljg3ODI3QzYuMzYzMDcgNS4xNjIwNSA2LjYwNDQ1IDUuMzgwNzggNi44OTY1MyA1LjM4MDc4QzcuMjE1MTUgNS4zODA3OCA3LjQ3MzQ1IDUuMTIwNDggNy40NzM0NSA0Ljc5OTM4VjQuMDUzOTdMMTIuNTMzNiA0LjA1Mzk3Wk0zLjY1Mzg0IDguNTY5NTJMMy42NTM4NCAxNC4wODdDMy42NTM4NCAxNi4wODkyIDQuNzYxMjYgMTcuMTcwOSA2Ljc0Njg4IDE3LjE3MDlIMTMuMjUzQzE1LjI0NTUgMTcuMTcwOSAxNi4zNDYxIDE2LjExMTggMTYuMzQ2MSAxNC4xNDU3TDE2LjM0NjEgOC41Njk1MkwzLjY1Mzg0IDguNTY5NTJaTTE0LjAwMSAxMS4wMTU2QzE0LjAwMSAxMC42OTQ1IDEzLjc0MjcgMTAuNDM0MiAxMy40MjQxIDEwLjQzNDJMMTMuMzM4NyAxMC40Mzk1QzEzLjA1NzEgMTAuNDc4IDEyLjg0IDEwLjcyMTMgMTIuODQgMTEuMDE1NkMxMi44NCAxMS4zMzY3IDEzLjA5ODMgMTEuNTk3IDEzLjQyNDEgMTEuNTk3TDEzLjUwMjMgMTEuNTkxN0MxMy43ODM5IDExLjU1MzIgMTQuMDAxIDExLjMwOTkgMTQuMDAxIDExLjAxNTZaTTEwLjAxMDYgMTAuNDM0MkMxMC4zMjkzIDEwLjQzNDIgMTAuNTg3NiAxMC42OTQ1IDEwLjU4NzYgMTEuMDE1NkMxMC41ODc2IDExLjMwOTkgMTAuMzcwNSAxMS41NTMyIDEwLjA4ODkgMTEuNTkxN0wxMC4wMTA2IDExLjU5N0M5LjY4NDkgMTEuNTk3IDkuNDI2NiAxMS4zMzY3IDkuNDI2NiAxMS4wMTU2QzkuNDI2NiAxMC43MjEzIDkuNjQzNjQgMTAuNDc4IDkuOTI1MjQgMTAuNDM5NUwxMC4wMTA2IDEwLjQzNDJaTTcuMTY3MDIgMTEuMDE1NkM3LjE2NzAyIDEwLjY5NDUgNi45MDg3MyAxMC40MzQyIDYuNTkwMSAxMC40MzQyTDYuNTA0NjkgMTAuNDM5NUM2LjIyMzEgMTAuNDc4IDYuMDA2MDYgMTAuNzIxMyA2LjAwNjA2IDExLjAxNTZDNi4wMDYwNiAxMS4zMzY3IDYuMjY0MzUgMTEuNTk3IDYuNTgyOTggMTEuNTk3TDYuNjY4MzkgMTEuNTkxN0M2Ljk0OTk4IDExLjU1MzIgNy4xNjcwMiAxMS4zMDk5IDcuMTY3MDIgMTEuMDE1NlpNMTMuNDI0MSAxMy40NDdDMTMuNzQyNyAxMy40NDcgMTQuMDAxIDEzLjcwNzMgMTQuMDAxIDE0LjAyODRDMTQuMDAxIDE0LjMyMjcgMTMuNzgzOSAxNC41NjYgMTMuNTAyMyAxNC42MDQ1TDEzLjQyNDEgMTQuNjA5OEMxMy4wOTgzIDE0LjYwOTggMTIuODQgMTQuMzQ5NSAxMi44NCAxNC4wMjg0QzEyLjg0IDEzLjczNDEgMTMuMDU3MSAxMy40OTA4IDEzLjMzODcgMTMuNDUyM0wxMy40MjQxIDEzLjQ0N1pNMTAuNTg3NiAxNC4wMjg0QzEwLjU4NzYgMTMuNzA3MyAxMC4zMjkzIDEzLjQ0NyAxMC4wMTA2IDEzLjQ0N0w5LjkyNTI0IDEzLjQ1MjNDOS42NDM2NCAxMy40OTA4IDkuNDI2NiAxMy43MzQxIDkuNDI2NiAxNC4wMjg0QzkuNDI2NiAxNC4zNDk1IDkuNjg0OSAxNC42MDk4IDEwLjAxMDYgMTQuNjA5OEwxMC4wODg5IDE0LjYwNDVDMTAuMzcwNSAxNC41NjYgMTAuNTg3NiAxNC4zMjI3IDEwLjU4NzYgMTQuMDI4NFpNNi41OTAxIDEzLjQ0N0M2LjkwODczIDEzLjQ0NyA3LjE2NzAyIDEzLjcwNzMgNy4xNjcwMiAxNC4wMjg0QzcuMTY3MDIgMTQuMzIyNyA2Ljk0OTk4IDE0LjU2NiA2LjY2ODM5IDE0LjYwNDVMNi41ODI5OCAxNC42MDk4QzYuMjY0MzUgMTQuNjA5OCA2LjAwNjA2IDE0LjM0OTUgNi4wMDYwNiAxNC4wMjg0QzYuMDA2MDYgMTMuNzM0MSA2LjIyMzEgMTMuNDkwOCA2LjUwNDY5IDEzLjQ1MjNMNi41OTAxIDEzLjQ0N1oiIGZpbGw9IiM1MzRFNTYiLz4KPC9zdmc+Cg==);
        }

        /* Date picker */
        .bootstrap-datetimepicker-widget.dropdown-menu {
            background-color: #FFFFFF;
            -webkit-box-shadow: 0px 4px 32px rgba(24, 24, 24, 0.08);
            box-shadow: 0px 4px 32px rgba(24, 24, 24, 0.08);
            border-radius: 4px;
            border: none;
            margin: 4px 0;
            padding: 16px;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            color: #3C3C3F;
        }

        .bootstrap-datetimepicker-widget.dropdown-menu:before,
        .bootstrap-datetimepicker-widget.dropdown-menu:after {
            content: none;
        }

        .bootstrap-datetimepicker-widget table {
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
        }

        .bootstrap-datetimepicker-widget table thead th,
        .bootstrap-datetimepicker-widget table thead td {
            font-weight: 600;
        }

        .bootstrap-datetimepicker-widget table thead .dow {
            color: var(--primary-color);
            font-weight: 500;
        }

        .bootstrap-datetimepicker-widget table tr th,
        .bootstrap-datetimepicker-widget table tr td {
            line-height: 24px;
            padding: 6px;
        }

        .bootstrap-datetimepicker-widget table tr th.day,
        .bootstrap-datetimepicker-widget table tr td.day {
            line-height: 24px;
        }

        .bootstrap-datetimepicker-widget table tr th.old,
        .bootstrap-datetimepicker-widget table tr td.old,
        .bootstrap-datetimepicker-widget table tr th.new,
        .bootstrap-datetimepicker-widget table tr td.new {
            color: #BABBBF;
        }

        .bootstrap-datetimepicker-widget table tr th.active,
        .bootstrap-datetimepicker-widget table tr td.active {
            background: var(--primary-color);
            border-radius: 50px;
            text-shadow: none;
        }

        .bootstrap-datetimepicker-widget table tr th.active:before,
        .bootstrap-datetimepicker-widget table tr td.active:before {
            content: none;
        }

        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-right,
        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-left {
            width: 24px;
            height: 24px;
            background-position: center;
            background-repeat: no-repeat;
            display: inline-block;
            vertical-align: middle;
        }

        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-right:before,
        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-left:before,
        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-right:after,
        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-left:after {
            content: none;
        }

        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-right {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTcuNzQ1OSAxOS43NTg5QzcuNDQ3ODQgMTkuNDY2NyA3LjQyMDc0IDE5LjAwOTUgNy42NjQ2MSAxOC42ODczTDcuNzQ1OSAxOC41OTVMMTQuNDczNCAxMkw3Ljc0NTkgNS40MDUwM0M3LjQ0Nzg0IDUuMTEyODMgNy40MjA3NCA0LjY1NTU4IDcuNjY0NjEgNC4zMzMzOEw3Ljc0NTkgNC4yNDEwNkM4LjA0Mzk2IDMuOTQ4ODcgOC41MTAzNyAzLjkyMjMgOC44MzkwNCA0LjE2MTM3TDguOTMzMjEgNC4yNDEwNkwxNi4yNTQxIDExLjQxOEMxNi41NTIyIDExLjcxMDIgMTYuNTc5MyAxMi4xNjc1IDE2LjMzNTQgMTIuNDg5N0wxNi4yNTQxIDEyLjU4Mkw4LjkzMzIxIDE5Ljc1ODlDOC42MDUzNCAyMC4wODA0IDguMDczNzYgMjAuMDgwNCA3Ljc0NTkgMTkuNzU4OVoiIGZpbGw9IiNBNkE2QTYiLz4KPC9zdmc+Cg==);
        }

        .bootstrap-datetimepicker-widget .glyphicon.glyphicon-chevron-left {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2LjI1NDEgNC4yNDEwNkMxNi41NTIyIDQuNTMzMjYgMTYuNTc5MyA0Ljk5MDUxIDE2LjMzNTQgNS4zMTI3MkwxNi4yNTQxIDUuNDA1MDNMOS41MjY1OCAxMkwxNi4yNTQxIDE4LjU5NUMxNi41NTIyIDE4Ljg4NzIgMTYuNTc5MyAxOS4zNDQ0IDE2LjMzNTQgMTkuNjY2NkwxNi4yNTQxIDE5Ljc1ODlDMTUuOTU2IDIwLjA1MTEgMTUuNDg5NiAyMC4wNzc3IDE1LjE2MSAxOS44Mzg2TDE1LjA2NjggMTkuNzU4OUw3Ljc0NTkgMTIuNTgyQzcuNDQ3ODQgMTIuMjg5OCA3LjQyMDc0IDExLjgzMjUgNy42NjQ2MSAxMS41MTAzTDcuNzQ1OSAxMS40MThMMTUuMDY2OCA0LjI0MTA2QzE1LjM5NDcgMy45MTk2NSAxNS45MjYyIDMuOTE5NjUgMTYuMjU0MSA0LjI0MTA2WiIgZmlsbD0iI0E2QTZBNiIvPgo8L3N2Zz4K);
        }

        /* Date picker */

        .home-form {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/customer.css') }}">
@endpush

@push('javascript')
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            /*
            $('.select2Product').select2({
                placeholder: 'Tìm kiếm sản phẩm...',
                ajax: {
                    url: '{{ route("patient.searchProducts") }}',
                    dataType: 'json',
                    delay: 1000,
                    minimumInputLength: 3,
                    data: function(params) {
                        return { q: params.term };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return { id: item.id, text: item.title };
                            })
                        };
                    },
                    cache: true
                }
            });*/

            $('select[name="product"]').change(function() {
                var id = $(this).val();
                $.get(
                    '{{ route("patient.getMaxPatient") }}', {
                        type: 'GET',
                        id: id
                    },
                    function(data) {
                        var elQuantity = $('#validationQuantity');
                        var quantity = 0;
                        if( data ) {
                            quantity = data.val;
                        }
                        elQuantity.prop('disabled', false)
                        elQuantity.attr('max', quantity);
                        elQuantity.prev().find('.inventory').html('(Số lượng nhỏ hơn ' + quantity + ')');
                        elQuantity.prev().find('.inventory').removeClass('d-none');
                    }
                );
            })

            // Datepicker
            if ($('input.date').length) {
                $('input.date').datetimepicker({
                    format: 'LT',
                    format: 'DD / MM / YYYY'
                });
            }
        });

        function changeQuantity(el) {
            var qty = el.value;
            var maxQty = el.getAttribute('max');
            if( qty > maxQty ) {
                //alert('Số lượng nhập lớn hơn số lượng trong kho!');
                //el.value = maxQty
            }
        }
    </script>
    <script>

        $(document).ready(function () {
            $('.select2, .select2Product').select2();
        });

        $(document).ready(function () {

            // Chuyển đổi mảng php thành obj
            const optionData = @json(!empty($products) ? $products : []);

            // Giá trị lớn nhất của mảng dữ liệu trên
            const MAX_OPTION_LENGTH = optionData.length;

            // Cập nhật nút thêm sản phẩm
            function updateAddButtonVisibility() {
                const currentLength = $('#select-container .row').length; // Số lượng row trong container

                if (currentLength >= MAX_OPTION_LENGTH) {
                    $('#add-select').hide();  // Ẩn nút thêm sản phẩm
                } else {
                    $('#add-select').show();  // Hiển thị nút thêm sản phẩm
                }
            }

            // Thêm html cho các trường: select và input
            function addSelect() {
                const currentLength = $('#select-container .row').length; // Get current row count

                if (currentLength >= MAX_OPTION_LENGTH) {
                    alert("Maximum limit of " + MAX_OPTION_LENGTH + " options reached.");
                    return;
                }

                const $row = $('<div class="row"></div>');

                // Cột sản phẩm
                const $selectCol = $('<div class="col-md-5 form-group"></div>');
                const $selectLabel = $('<label class="form-label">Sản phẩm<sup>*</sup></label>');
                const $select = $('<select class="form-control select2" name="products[]"><option></option></select>');

                optionData.forEach(opt => {
                    $select.append(`<option value="${opt.id}">${opt.text}</option>`);
                });

                $selectCol.append($selectLabel);
                $selectCol.append($select);

                // Cột số lượng
                const $inputCol = $('<div class="col-md-6 form-group"></div>');
                const $inputLabel = $('<label class="form-label">Số lượng<sup>*</sup> <span class="inventory badge rounded-pill bg-danger d-none">(Số lượng nhỏ hơn 0)</span></label>');
                const $input = $('<input type="number" class="form-control qty" name="quantities[]" disabled placeholder="">');

                $inputCol.append($inputLabel);
                $inputCol.append($input);

                // Cột nút xoá
                const $removeBtnCol = $('<div class="col-md-1 form-group text-sm-end"></div>');
                const $removeBtnLabel = $('<label class="form-label w-100 opacity-0">Xoá</label>');
                const $removeBtn = $('<button type="button" class="btn btn-danger remove-btn header-top" style="min-width: unset;width: 100%;">x</button>');
                $removeBtnCol.append($removeBtnLabel);
                $removeBtnCol.append($removeBtn);

                // Thêm các cột vào trong row
                $row.append($selectCol);
                $row.append($inputCol);
                $row.append($removeBtnCol);

                // Thêm row vào trong container
                $('#select-container').append($row);

                // Khởi tạo select2
                $select.select2({
                    placeholder: '-- Chọn --',
                    allowClear: true,
                    width: '100%'
                });

                // Cập nhật ẩn các giá trị đã thêm ở select trước đó
                updateDisabledOptions();

                // Cập nhật trạng thái ẩn/hiện của nút thêm sản phẩm
                updateAddButtonVisibility();
            }

            // Thực hiện xoá hàng
            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.row').remove();
                updateDisabledOptions();

                // Cập nhật lại trạng thái ẩn/hiện khi xoá hàng
                updateAddButtonVisibility();
            });

            // Loại bỏ những giá trị đã thêm ở các select trước đó
            function updateDisabledOptions() {
                const selected = [];

                $('.select2').each(function () {
                    const val = $(this).val();
                    if (val) selected.push(val);
                });

                $('.select2').each(function () {
                    const currentVal = $(this).val();

                    $(this).find('option').each(function () {
                        const val = $(this).val();
                        if (val && val !== currentVal && selected.includes(val)) {
                            $(this).prop('disabled', true);
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });

                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }

                    $(this).select2({
                        placeholder: '-- Chọn --',
                        allowClear: true,
                        width: '100%'
                    });
                });
            }

            // Thêm hàng đầu tiên
            //addSelect();

            // Thêm hàng mới khi click
            $('#add-select').on('click', function () {
                addSelect();
            });

            // Cập nhật khi thay đổi giá trị select
            $(document).on('change', '.select2', function () {
                updateDisabledOptions();
            });
        });

        // Tìm kiếm sản phẩm và thêm giá trị max vào input
        $(document).on('change', '.select2', function () {
            var _this = $(this);
            var id = _this.val();
            $.ajax({
                url: '<?php echo route("patientBuy.searchProducts") ?>',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    var elQuantity = _this.parents('.form-group').next().find('input');
                    var quantity = 0;
                    if( data ) {
                        quantity = data.quantity;
                    }
                    elQuantity.prop('disabled', false)
                    elQuantity.attr('max', quantity);
                    elQuantity.prev().find('.inventory').html('(Số lượng nhỏ hơn ' + quantity + ')');
                    elQuantity.prev().find('.inventory').removeClass('d-none');
                }
            })
        });

        // Kiểm tra giá trị số lượng khi nhập
        $(document).on('input', 'input[name="quantities[]"]', function () {
            var MAX_INPUT_VALUE = $(this).attr('max');
            var val = parseFloat($(this).val());
            if (val > MAX_INPUT_VALUE) {
                alert('Số lượng không vượt quá ' + MAX_INPUT_VALUE);
                $(this).val(MAX_INPUT_VALUE);
            } else if( val == 0 ) {
                alert('Số lượng không được để trống');
                $(this).addClass('border-danger');
            } else {
                $(this).removeClass('border-danger');
            }
        });

        $('#patientBuy').on('submit', function (e) {
            let valid = true;
            $('input[name="quantities[]"]').each(function () {
                var MAX_INPUT_VALUE = $(this).attr('max');
                const val = parseFloat($(this).val());
                if (isNaN(val) || val > MAX_INPUT_VALUE) {
                    $(this).addClass('border-danger');
                    valid = false;
                } else if( val == 0 ) {
                    $(this).addClass('border-danger');
                    valid = false;
                } else {
                    $(this).removeClass('border-danger');
                }
            });
            if (!valid) {
                alert('Số lượng răng nhập không đúng');
                e.preventDefault();
                return false;
            }
        });

    </script>
@endpush
