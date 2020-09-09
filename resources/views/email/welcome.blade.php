<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color: rgb(240, 240, 240);">

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* GT AMERICA */
        @font-face {
            font-display: fallback;
            font-family: 'GT America Regular';
            font-weight: 400;
            src: url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Regular.woff2') format('woff2'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Regular.woff') format('woff'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Regular.ttf') format('truetype');
        }

        @font-face {
            font-display: fallback;
            font-family: 'GT America Medium';
            font-weight: 600;
            src: url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Medium.woff2') format('woff2'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Medium.woff') format('woff'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Standard-Medium.ttf') format('truetype');
        }

        @font-face {
            font-display: fallback;
            font-family: 'GT America Condensed Bold';
            font-weight: 700;
            src: url('https://www.exploretock.com/fonts/gt-america/GT-America-Condensed-Bold.woff2') format('woff2'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Condensed-Bold.woff') format('woff'), url('https://www.exploretock.com/fonts/gt-america/GT-America-Condensed-Bold.ttf') format('truetype');
        }

        /* CLIENT-SPECIFIC RESET */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Prevent WebKit and Windows mobile changing default text sizes */
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* Remove spacing between tables in Outlook 2007 and up */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* Allow smoother rendering of resized image in Internet Explorer */
        .im {
            color: inherit !important;
        }

        /* DEVICE-SPECIFIC RESET */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* iOS BLUE LINKS */
        /* RESET */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            display: block;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            border-collapse: collapse;
            display: table-cell;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* BG COLORS */
        .mainTable {
            background-color: #F0F0F0;
        }

        .mainTable--hospitality {
            background-color: #f7f2ed;
        }

        html {
            background-color: #F0F0F0;
        }

        /* VARIABLES */
        .bg-white {
            background-color: white;
        }

        .hr {
            /* Cross-client horizontal rule. Adapted from https://litmus.com/community/discussions/4633-is-there-a-reliable-1px-horizontal-rule-method */
            background-color: #d3d3d8;
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            mso-line-height-rule: exactly;
            line-height: 1px;
        }

        .textAlignLeft {
            text-align: left !important;
        }

        .textAlignRight {
            text-align: right !important;
        }

        .textAlignCenter {
            text-align: center !important;
        }

        .mt1 {
            margin-top: 6px;
        }

        .list {
            padding-left: 18px;
            margin: 0;
        }

        /* TYPOGRAPHY */
        body {
            font-family: 'GT America Regular', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 400;
            color: #4f4f65;
            -webkit-font-smoothing: antialiased;
            -ms-text-size-adjust: 100%;
            -moz-osx-font-smoothing: grayscale;
            font-smoothing: always;
            text-rendering: optimizeLegibility;
        }

        .h1 {
            font-family: 'GT America Condensed Bold', 'Roboto Condensed', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 700;
            vertical-align: middle;
            font-size: 36px;
            line-height: 42px;
        }

        .h2 {
            font-family: 'GT America Medium', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 600;
            vertical-align: middle;
            font-size: 16px;
            line-height: 24px;
        }

        .text {
            font-family: 'GT America Regular', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 21px;
        }

        .text-list {
            font-family: 'GT America Regular', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 25px;
        }

        .textSmall {
            font-family: 'GT America Regular', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 400;
            font-size: 14px;
        }

        .text-xsmall {
            font-family: 'GT America Regular', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            text-transform: uppercase;
            line-height: 22px;
            letter-spacing: 1px;
        }

        .text-bold {
            font-weight: 600;
        }

        .text-link {
            text-decoration: underline;
        }

        .text-linkNoUnderline {
            text-decoration: none;
        }

        .text-strike {
            text-decoration: line-through;
        }

        /* FONT COLORS */
        .textColorDark {
            color: #23233e;
        }

        .textColorNormal {
            color: #4f4f65;
        }

        .textColorBlue {
            color: #2020c0;
        }

        .textColorGrayDark {
            color: #7B7B8B;
        }

        .textColorGray {
            color: #A5A8AD;
        }

        .textColorWhite {
            color: #FFFFFF;
        }

        .textColorRed {
            color: #df3232;
        }

        /* BUTTON */
        .Button-primary-wrapper {
            border-radius: 3px;
            background-color: #2020C0;
        }

        .Button-primary {
            font-family: 'GT America Medium', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            border-radius: 3px;
            border: 1px solid #2020C0;
            color: #ffffff;
            display: block;
            font-size: 16px;
            font-weight: 600;
            padding: 18px;
            text-decoration: none;
        }

        .Button-secondary-wrapper {
            border-radius: 3px;
            background-color: #ffffff;
        }

        .Button-secondary {
            font-family: 'GT America Medium', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            border-radius: 3px;
            border: 1px solid #2020C0;
            color: #2020C0;
            display: block;
            font-size: 16px;
            font-weight: 600;
            padding: 18px;
            text-decoration: none;
        }

        /* LAYOUT */
        .Content-container {
            padding-left: 60px;
            padding-right: 60px;
        }

        .Content-container--main {
            padding-top: 54px;
            padding-bottom: 60px;
        }

        .Content {
            width: 580px;
            margin: 0 auto;
        }

        .wrapper {
            max-width: 600px;
        }

        .section {
            padding: 24px 0px;
            border-bottom: 1px solid #d3d3d8;
        }

        .section--noBorder {
            padding: 24px 0px 0;
        }

        .section--last {
            padding: 24px 0px;
        }

        .message {
            background-color: #F4F4F5;
            padding: 18px;
        }

        .card {
            border: 1px solid #d3d3d8;
            padding: 18px;
        }

        /* HEADER */
        .header-tockLogoImage {
            display: block;
            color: #F0F0F0;
        }

        .header-heroImage {
            padding-bottom: 24px;
        }

        /* PREHEADER */
        .preheader {
            display: none;
            font-size: 1px;
            color: #FFFFFF;
            line-height: 1px;
            max-height: 0px;
            max-width: 0px;
            opacity: 0;
            overflow: hidden;
        }

        /* BANNER */
        .notice {
            padding: 12px;
            background: #23233E;
            color: #FFFFFF;
            display: block;
            font-size: 14px;
            font-family: 'GT America Medium', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-weight: 600;
        }

        /* INTRO */
        .section--intro {
            padding-bottom: 48px;
        }

        /* BOOKING INFO */
        .business-logo__container {
            width: 48px;
            height: 48px;
            border-radius: 3px;
            border: 1px solid #d3d3d8;
            overflow: hidden;
        }

        .business-logo__image {
            border: 1px solid transparent;
            border-radius: 3px;
            width: 48px;
            height: 48px;
            display: block;
        }

        .business-address--address {
            width: 50%;
        }

        .business-address--map {
            width: 50%;
        }

        .business-address--map-image {
            width: 100%;
        }

        /* MOBILE TICKETS */
        .mobile-ticket--description {
            width: 65%;
            margin-top: 12px;
            margin-right: 5%;
        }

        .mobile-ticket--code {
            width: 30%;
        }

        .mobile-ticket--code-image {
            width: 100%;
        }

        /* RESERVATION ACTIONS */
        .linksTable {
            border-bottom: 1px solid #d3d3d8;
        }

        .linksTableRow {
            padding: 24px 12px;
        }

        .actions-icon {
            vertical-align: middle;
        }

        .actions-text {
            vertical-align: middle;
        }

        /* RECEIPT */
        .receipt__container {
            border: 1px solid #d3d3d8;
            padding: 24px;
        }

        .receipt__row {
            border-top: 1px solid #d3d3d8;
        }

        /* FEEDBACK ICONS */
        .feedback-link {
            border: 1px solid #d4d5da;
            border-radius: 3px;
            display: inline-block;
            width: calc(32% - 2px);
            padding: 10px 0;
        }

        .feedback-link-bumper {
            display: inline-block;
            width: 1%;
        }

        .feedback-link img {
            height: 50px;
            width: 50px;
        }

        /* SOCIAL ICONS */
        .social-link {
            display: inline-block;
            width: auto;
        }

        .social-link-text {
            padding: 14px 24px 14px 14px;
        }

        /* TABLET STYLES */
        @media screen and (max-width: 648px) {

            /* DEVICE-SPECIFIC RESET */
            div[style*='margin: 16px 0;'] {
                margin: 0 !important;
            }

            /* ANDROID CENTER FIX */
            /* LAYOUT */
            .wrapper {
                width: 100% !important;
                max-width: 100% !important;
            }

            .Content {
                width: 90% !important;
            }

            .Content-container {
                padding-left: 36px !important;
                padding-right: 36px !important;
            }

            .Content-container--main {
                padding-top: 30px !important;
                padding-bottom: 42px !important;
            }

            .responsiveTable {
                width: 100% !important;
            }

            /* RESERVATION ACTIONS */
            .linksTableRow {
                padding-left: 0 !important;
                padding-right: 0 !important;
                padding-top: 12px !important;
                padding-bottom: 12px !important;
            }

            .linksTableRow--borderRight {
                border-right: none !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            /* FEEDBACK LINK */
            .feedback-link img {
                height: 38px !important;
                width: 38px !important;
            }
        }

        /* MOBILE STYLES */
        @media screen and (max-width: 480px) {

            /* TYPOGRAPHY */
            .h1 {
                font-size: 30px !important;
                line-height: 30px !important;
            }

            .text {
                font-size: 16px !important;
                line-height: 22px !important;
            }

            /* BUTTON */
            .mobile-buttonContainer {
                width: 100% !important;
            }

            /* LAYOUT */
            .Content {
                width: 100% !important;
            }

            .Content-container {
                padding-left: 18px !important;
                padding-right: 18px !important;
            }

            .Content-container--main {
                padding-top: 24px !important;
                padding-bottom: 30px !important;
            }

            .section {
                padding: 18px 0 !important;
            }

            .section--last {
                padding: 18px 0 !important;
            }

            .header {
                padding: 0 18px !important;
            }

            .business-address--address {
                width: 100% !important;
            }

            .business-address--map {
                margin-top: 30px !important;
                width: 100% !important;
            }

            .mobile-ticket--description {
                width: 100% !important;
                margin-top: 0px !important;
            }

            .mobile-ticket--code {
                margin-top: 30px !important;
                margin-left: 0;
                width: 100% !important;
            }

            /* RECEIPT */
            .receipt__container {
                padding: 12px !important;
            }

            /* SOCIAL ICONS */
            .social-link {
                display: block !important;
                width: 100% !important;
                border-bottom: 1px solid #d3d3d8 !important;
            }

            /* INTRO */
            .section--intro {
                padding-top: 18px !important;
                padding-bottom: 18px !important;
            }
        }

    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; height: 100%; margin: 0; padding: 0; width: 100%; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; color: rgb(79, 79, 101); -webkit-font-smoothing: antialiased; -ms-text-size-adjust: 100%; -moz-osx-font-smoothing: grayscale; font-smoothing: always; text-rendering: optimizeLegibility;">
<!-- EXTRA METADATA MARKUP -->
<!--[if mso]>
<style type="text/css">
    .h1 {font-family: 'Helvetica', 'Arial', sans-serif !important; font-weight: 700 !important; vertical-align: middle !important; font-size: 36px !important; mso-line-height-rule: exactly;line-height: 42px !important;}
    .h2 {font-family: 'Helvetica', 'Arial', sans-serif !important;font-weight: 600 !important;vertical-align: middle !important;font-size: 16px !important;mso-line-height-rule: exactly;line-height: 24px !important;}
    .text {font-family: 'Helvetica', 'Arial', sans-serif !important;font-weight: 400 !important;font-size: 16px !important;mso-line-height-rule: exactly;line-height: 21px !important;}
    .text-list {font-family: 'Helvetica', 'Arial', sans-serif !important;font-weight: 400 !important;font-size: 16px !important;mso-line-height-rule: exactly;line-height: 25px !important;}
    .textSmall {font-family: 'Helvetica', 'Arial', sans-serif !important;font-weight: 400 !important;font-size: 14px !important;}
    .text-xsmall {font-family: 'Helvetica', 'Arial', sans-serif !important;font-size: 11px !important;text-transform: uppercase !important;mso-line-height-rule: exactly;line-height: 22px !important;letter-spacing: 1px !important;}
    .text-bold {font-weight: 600 !important;}
    .text-link {text-decoration: underline !important;}
    .text-linkNoUnderline {text-decoration: none !important;}
    .text-strike {text-decoration: line-through !important;}
    .textColorDark {color: #23233e !important;}
    .textColorNormal {color: #4f4f65 !important;}
    .textColorBlue {color: #2020c0 !important;}
    .textColorGray {color: #A5A8AD !important;}
    .textColorWhite {color: #FFFFFF !important;}
    .Button-primary {font-family: 'Helvetica', 'Arial', sans-serif !important;border-radius: 3px !important;border: 1px solid #2020C0 !important;color: #ffffff !important;display: block !important;font-size: 16px !important;font-weight: 600 !important;padding: 18px !important;text-decoration: none !important;}
    .Button-secondary {font-family: 'Helvetica', 'Arial', sans-serif !important;border-radius: 3px !important;border: 1px solid #2020C0 !important;color: #2020C0 !important;display: block !important;font-size: 16px !important;font-weight: 600 !important;padding: 18px !important;text-decoration: none !important;}
</style>
<![endif]-->
<!-- HIDDEN PREHEADER TEXT -->
<div class="preheader" style="display: none; font-size: 1px; color: rgb(255, 255, 255); line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class=" mainTable  " style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; background-color: rgb(240, 240, 240);">
    <!-- HEADER -->
    <tr>
        <td align="center" class="header" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="Content" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; width: 580px; margin: 0 auto;">
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                        <a href="http://{{ env('SITE_DOMAIN', '') }}" target="_blank" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                            <!--TOP IMAGE-->
                            <img src="{{ url('img/logo.png') }}" width="74" height="22" alt="logo" border="0" class="header-tockLogoImage" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; display: block; color: rgb(240, 240, 240);" />

                        </a> </td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- CONTENT -->
    <tr>
        <td align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="Content bg-white" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; background-color: white; width: 580px; margin: 0 auto;">
                <tr>
                    <td class="Content-container Content-container--main text textColorNormal" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; font-size: 16px; line-height: 21px; color: rgb(79, 79, 101); padding-left: 60px; padding-right: 60px; padding-top: 54px; padding-bottom: 60px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                            <tr>
                                <td valign="top" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                                        <tr>
                                            <td align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;"> <span class="h1 textColorDark" style="font-family: &quot;GT America Condensed Bold&quot;, &quot;Roboto Condensed&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 700; vertical-align: middle; font-size: 36px; line-height: 42px; color: rgb(35, 35, 62);">Welcome</span> </td>
                                        </tr>
                                        <tr class="spacer">
                                            <td height="18px" colspan="2" style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2" valign="top" width="100%" height="1" class="hr" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; background-color: rgb(211, 211, 216); border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; mso-line-height-rule: exactly; line-height: 1px;">
                                                <!--[if gte mso 15]>&nbsp;<![endif]-->
                                            </td>
                                        </tr>
                                        <tr class="spacer">
                                            <td height="18px" colspan="2" style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                                        <tr>
                                            <td align="left" class="text textColorNormal" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; font-size: 16px; line-height: 21px; color: rgb(79, 79, 101);">
                                                Hello {{ $names }},
                                                <br>
                                                <br>
                                                Welcome to {{ env('APP_NAME', '') }}.
                                                <br>

                                            </td>
                                        </tr>
                                        <tr class="spacer">
                                            <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="text textColorNormal" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; font-size: 16px; line-height: 21px; color: rgb(79, 79, 101);">

                                                Your account has been created successfully. Click the link below to activate your account.
                                                <br>

                                            </td>
                                        </tr>
                                        <tr class="spacer">
                                            <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="center" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                                                    <tr>
                                                        <td align="center" valign="center" width="100%" class="Button-primary-wrapper" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; border-radius: 3px; background-color: rgb(32, 32, 192);">
                                                            <!--BUTTON RESET-->
                                                            <a href="{{ $link }}" target="_blank" class="Button-primary" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: &quot;GT America Medium&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; border-radius: 3px; border: 1px solid rgb(32, 32, 192); color: rgb(255, 255, 255); display: block; font-size: 16px; font-weight: 600; padding: 18px; text-decoration: none;"> Activate Account </a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="text textColorNormal" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; font-size: 16px; line-height: 21px; color: rgb(79, 79, 101);">
                                                            or use the link below
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="text textColorNormal" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; font-size: 16px; line-height: 21px; color: rgb(79, 79, 101);">
                                                            <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- FOOTER -->
    <tr>
        <td align="center" class="Content" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; width: 580px; margin: 0 auto;">
            <!-- Will most likely required a feature flag -->
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="Content-container" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; padding-left: 60px; padding-right: 60px;">
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                        <a href="http://{{ env('SITE_DOMAIN', '') }}" target="_blank" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                            <!--TOP IMAGE-->
                            <img src="{{ url('img/logo.png') }}" width="74" height="22" alt="logo" border="0" class="header-tockLogoImage" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; display: block; color: rgb(240, 240, 240);" />

                        </a> </td>
                </tr>
                <tr class="spacer">
                    <td height="18px" colspan="2" style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                        <div class="text-xsmall textColorNormal" style="font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-size: 11px; text-transform: uppercase; line-height: 22px; letter-spacing: 1px; color: rgb(79, 79, 101);">
                            © {{ date('Y') }} | {{ env('APP_NAME', '') }}
                        </div>
                        <div class="text-xsmall textColorNormal" style="font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-size: 11px; text-transform: uppercase; line-height: 22px; letter-spacing: 1px; color: rgb(79, 79, 101);">
                            All Rights Reserved
                        </div>
                    </td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
                <tr class="spacer">
                    <td height="12px" colspan="2" style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">&nbsp;</td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>

</body>

</html>
