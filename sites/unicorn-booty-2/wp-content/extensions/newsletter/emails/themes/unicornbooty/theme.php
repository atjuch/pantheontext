<?php
/*
 * Some variables are already defined:
 *
 * - $theme_options An array with all theme options
 * - $theme_url Is the absolute URL to the theme folder used to reference images
 * - $theme_subject Will be the email subject if set by this theme
 *
 */

global $newsletter, $post;

$color = $theme_options['theme_color'];
if ( empty( $color ) ) {
    $color = '#000000';
}

if ( isset( $theme_options['theme_posts'] ) ) {
    $filters = array();

    if ( empty( $theme_options['theme_max_posts'] ) ) {
        $filters['showposts'] = 10;
    } else {
        $filters['showposts'] = (int) $theme_options['theme_max_posts'];
    }

    if ( ! empty( $theme_options['theme_categories'] ) ) {
        $filters['category__in'] = $theme_options['theme_categories'];
    }

    if ( ! empty( $theme_options['theme_tags'] ) ) {
        $filters['tag'] = $theme_options['theme_tags'];
    }

    if ( ! empty( $theme_options['theme_post_types'] ) ) {
        $filters['post_type'] = $theme_options['theme_post_types'];
    }

    $posts = get_posts( $filters );
}

?>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraph.org/schema/">
<head>

    <meta property="og:title" content="Unicorn Booty Call: Where Are All The Same-Sex Love Songs?">
    <meta property="fb:page_id" content="43929265776">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- NAME: 1:3:2 COLUMN -->
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css"> p {
            margin: 1em 0;
        }

        a {
            word-wrap: break-word;
        }

        table {
            border-collapse: collapse;
        }

        h1, h2, h3, h4, h5, h6 {
            display: block;
            margin: 0;
            padding: 0;
        }

        img, a img {
            border: 0;
            height: auto;
            outline: none;
            text-decoration: none;
        }

        body, #bodyTable, #bodyCell {
            height: 100% !important;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        #outlook a {
            padding: 0;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        p, a, li, td, blockquote {
            mso-line-height-rule: exactly;
        }

        a[href^=tel], a[href^=sms] {
            color: inherit;
            cursor: default;
            text-decoration: none;
        }

        p, a, li, td, body, table, blockquote {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font {
            line-height: 100%;
        }

        #bodyCell {
            padding-top: 20px;
            padding-right: 10px;
            padding-bottom: 20px;
            padding-left: 10px;
        }

        .templateContainer {
            max-width: 600px;
        }

        .threeColumnsContainer {
            max-width: 197px;
        }

        .lowerColumnContainer {
            max-width: 298px;
        }

        a.mcnButton {
            display: block;
        }

        .mcnImage {
            vertical-align: bottom;
        }

        .mcnTextContent img {
            height: auto !important;
        }

        body, #bodyTable {
            background-color: #F2F2F2;
        }

        #bodyCell {
            border-top: 0;
        }

        .templateContainer {
            border: 0;
        }

        h1 {
            color: #606060 !important;
            font-family: Helvetica;
            font-size: 40px;
            font-style: normal;
            font-weight: bold;
            line-height: 125%;
            letter-spacing: -1px;
            text-align: left;
        }

        h2 {
            color: #404040 !important;; /*@editable*/
            font-family: Helvetica;
            font-size: 26px;
            font-style: normal;
            font-weight: bold;
            line-height: 125%;
            letter-spacing: -.75px;
            text-align: left;
        }

        h3 {
            color: #606060 !important;
            font-family: Helvetica;
            font-size: 18px;
            font-style: normal;
            font-weight: bold;
            line-height: 125%;
            letter-spacing: -.5px;
            text-align: left;
        }

        h4 {
            color: #808080 !important;
            font-family: Helvetica;
            font-size: 15px;
            font-style: normal;
            font-weight: bold;
            line-height: 125%;
            letter-spacing: normal;
            text-align: left;
        }

        #templatePreheader {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .preheaderContainer .mcnTextContent, .preheaderContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 11px;
            line-height: 125%;
            text-align: left;
        }

        .preheaderContainer .mcnTextContent a {
            color: #606060;
            font-weight: normal;
            text-decoration: underline;
        }

        #templateHeader {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .headerContainer .mcnTextContent, .headerContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .headerContainer .mcnTextContent a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        #templateBody {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .bodyContainer .mcnTextContent, .bodyContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .bodyContainer .mcnTextContent a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        #templateUpperColumns {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .upperLeftColumnContainer .mcnTextContent, .upperLeftColumnContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .upperLeftColumnContainer .mcnTextContent a, .upperLeftColumnContainer .mcnTextContent p a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        .upperCenterColumnContainer .mcnTextContent, .upperCenterColumnContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .upperCenterColumnContainer .mcnTextContent a, .upperCenterColumnContainer .mcnTextContent p a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        .upperRightColumnContainer .mcnTextContent, .upperRightColumnContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .upperRightColumnContainer .mcnTextContent a, .upperRightColumnContainer .mcnTextContent p a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        #templateLowerColumns {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .lowerLeftColumnContainer .mcnTextContent, .lowerLeftColumnContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .lowerLeftColumnContainer .mcnTextContent a, .lowerLeftColumnContainer .mcnTextContent p a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        .lowerRightColumnContainer .mcnTextContent, .lowerRightColumnContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 15px;
            line-height: 150%;
            text-align: left;
        }

        .lowerRightColumnContainer .mcnTextContent a, .lowerRightColumnContainer .mcnTextContent p a {
            color: #6DC6DD;
            font-weight: normal;
            text-decoration: underline;
        }

        #templateFooter {
            background-color: #FFFFFF;
            border-top: 0;
            border-bottom: 0;
        }

        .footerContainer .mcnTextContent, .footerContainer .mcnTextContent p {
            color: #606060;
            font-family: Helvetica;
            font-size: 11px;
            line-height: 125%;
            text-align: center;
        }

        .footerContainer .mcnTextContent a, .footerContainer .mcnTextContent p a {
            color: #606060;
            font-weight: normal;
            text-decoration: underline;
        }

        @media screen and (min-width: 768px) {
            .templateContainer {
                width: 600px !important;
            }
        }

        @media screen and (min-width: 768px) {
            .threeColumnsContainer {
                width: 197px;
            }
        }

        @media screen and (min-width: 768px) {
            .lowerColumnContainer {
                width: 298px;
            }
        }

        @media only screen and (max-width: 480px) {
            body {
                width: 100% !important;
                min-width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td#bodyCell {
                padding-top: 10px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            .threeColumnsContainer {
                max-width: 100% !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            .upperColumnWidth {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            .lowerColumnContainer {
                max-width: 100% !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            img.mcnImage, table.mcnShareContent, table.mcnCaptionTopContent, table.mcnCaptionBottomContent, table.mcnTextContentContainer, table.mcnBoxedTextContentContainer, table.mcnImageGroupContentContainer, table.mcnCaptionLeftTextContentContainer, table.mcnCaptionRightTextContentContainer, table.mcnCaptionLeftImageContentContainer, table.mcnCaptionRightImageContentContainer, table.mcnImageCardLeftTextContentContainer, table.mcnImageCardRightTextContentContainer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnImageGroupContent {
                padding: 9px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            table.mcnCaptionLeftContentOuter td.mcnTextContent, table.mcnCaptionRightContentOuter td.mcnTextContent {
                padding-top: 9px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnImageCardTopImageContent, td.mcnCaptionBlockInner table.mcnCaptionTopContent:last-child td.mcnTextContent {
                padding-top: 18px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnImageCardBottomImageContent {
                padding-bottom: 9px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnImageGroupBlockInner {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
        }

        @media only screen and (max-width: 480px) {
            tbody.mcnImageGroupBlockOuter {
                padding-top: 9px !important;
                padding-bottom: 9px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnTextContent, td.mcnBoxedTextContentColumn {
                padding-right: 18px !important;
                padding-left: 18px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.mcnImageCardLeftImageContent, td.mcnImageCardRightImageContent {
                padding-right: 18px !important;
                padding-bottom: 0 !important;
                padding-left: 18px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.threeColumnsContainer, td.lowerColumnContainer {
                display: block !important;
                max-width: 600px !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            table.mcpreview-image-uploader {
                display: none !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.footerContainer a.utilityLink {
                display: block !important;
            }
        }

        @media only screen and (max-width: 480px) {
            h1 {
                font-size: 24px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            h2 {
                font-size: 20px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            h3 {
                font-size: 18px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            h4 {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            table.mcnBoxedTextContentContainer td.mcnTextContent, td.mcnBoxedTextContentContainer td.mcnTextContent p {
                font-size: 18px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td#templatePreheader {
                display: block !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.preheaderContainer td.mcnTextContent, td.preheaderContainer td.mcnTextContent p {
                font-size: 14px !important;
                line-height: 115% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.headerContainer td.mcnTextContent, td.headerContainer td.mcnTextContent p {
                font-size: 18px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.bodyContainer td.mcnTextContent, td.bodyContainer td.mcnTextContent p {
                font-size: 18px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.upperLeftColumnContainer td.mcnTextContent, td.upperLeftColumnContainer td.mcnTextContent p {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.upperCenterColumnContainer td.mcnTextContent, td.upperCenterColumnContainer td.mcnTextContent p {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.upperRightColumnContainer td.mcnTextContent, td.upperRightColumnContainer td.mcnTextContent p {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.lowerLeftColumnContainer td.mcnTextContent, td.lowerLeftColumnContainer td.mcnTextContent p {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.lowerRightColumnContainer td.mcnTextContent, td.lowerRightColumnContainer td.mcnTextContent p {
                font-size: 16px !important;
                line-height: 125% !important;
            }
        }

        @media only screen and (max-width: 480px) {
            td.footerContainer td.mcnTextContent, td.footerContainer td.mcnTextContent p {
                font-size: 14px !important;
                line-height: 115% !important;
            }
        } </style>
</head>
<body id="archivebody"
      style="margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F2F2F2;height: 100% !important;width: 100% !important;">

<center>
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable"
           style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #F2F2F2;height: 100% !important;width: 100% !important;">
        <tbody>
        <tr>
            <td align="center" valign="top" id="bodyCell"
                style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;padding-top: 20px;padding-right: 10px;padding-bottom: 20px;padding-left: 10px;border-top: 0;height: 100% !important;width: 100% !important;">
                <!--[if gte mso 9]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" style="width:600px;" width="600">
                    <tr>
                        <td align="center" valign="top">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"
                       style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px;border: 0;">
                    <tbody>
                    <tr>
                        <td align="center" valign="top" id="templatePreheader"
                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                            <!-- BEGIN PREHEADER // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody>
                                <tr>
                                    <td valign="top" class="preheaderContainer"
                                        style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="mcnTextBlock"
                                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody class="mcnTextBlockOuter">
                                            <tr>
                                                <td valign="top" class="mcnTextBlockInner"
                                                    style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           width="366" class="mcnTextContentContainer"
                                                           style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                        <tbody>
                                                        <tr>

                                                            <td valign="top" class="mcnTextContent"
                                                                style="padding-top: 9px;padding-left: 18px;padding-bottom: 9px;padding-right: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;">

                                                                Your weekly stash of Unicorn Booty's best gems!
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- // END PREHEADER -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" id="templateHeader"
                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                            <!-- BEGIN HEADER // -->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody>
                                <tr>
                                    <td align="center" valign="top" class="headerContainer"
                                        style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="mcnImageBlock"
                                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody class="mcnImageBlockOuter">
                                            <tr>
                                                <td valign="top"
                                                    style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"
                                                    class="mcnImageBlockInner">
                                                    <table align="left" width="100%" border="0" cellpadding="0"
                                                           cellspacing="0" class="mcnImageContentContainer"
                                                           style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="mcnImageContent" valign="top"
                                                                style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                                                <a href="https://unicornbooty.com/"
                                                                   title="<?php echo $theme_options['main_header_title'] ?>"
                                                                   class="" target="_blank"
                                                                   style="word-wrap: break-word;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <?php
                                                                    if ( ! empty( $theme_options['theme_header_logo']['url'] ) ) { ?>
                                                                        <img align="left"
                                                                             alt="<?php echo $theme_options['main_header_title'] ?>"
                                                                             src="<?php echo $theme_options['theme_header_logo']['url'] ?>"
                                                                             width="564"
                                                                             style="max-width: 566px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                             class="mcnImage">
                                                                    <?php } elseif ( ! empty( $theme_options['main_header_logo']['url'] ) ) { ?>
                                                                        <img align="left"
                                                                             alt="<?php echo $theme_options['main_header_title'] ?>"
                                                                             src="<?php echo $theme_options['main_header_logo']['url'] ?>"

                                                                             width="564"
                                                                             style="max-width: 566px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                             class="mcnImage">
                                                                    <?php } elseif ( ! empty( $theme_options['main_header_title'] ) ) {
                                                                        echo $theme_options['main_header_title'];
                                                                    } ?>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- // END HEADER -->
                        </td>
                    </tr>


                    <tr>
                        <td align="center" valign="top" id="templateBody"
                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                            <!-- BEGIN BODY // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody>


                                <tr>
                                    <td valign="top" class="bodyContainer"
                                        style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="mcnTextBlock"
                                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody class="mcnTextBlockOuter">
                                            <tr>
                                                <td valign="top" class="mcnTextBlockInner"
                                                    style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           width="600" class="mcnTextContentContainer"
                                                           style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                        <tbody>
                                                        <tr>

                                                            <td valign="top" class="mcnTextContent"
                                                                style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;">
                                                                <p>Here you can start to write your message. Be polite
                                                                    with your readers! Don't forget the subject
                                                                    of this message.</p>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- // END BODY -->
                        </td>
                    </tr>




                    <?php
                    $y = 0;
                    for ( $i = 0; $i < count( $posts ); $i ++ ) {
                        if ( $y == 0 ) {
                            ?>
                            <tr>
                            <!-- BEGIN 3 COLUMNS // -->
                            <td align="center" valign="top" id="templateUpperColumns"
                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                            style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <tbody>
                            <tr><?php
                        }
                        $post = $posts[ $i ];
                        setup_postdata( $post ); ?>
                        <td align="center"
                            style="text-align: center;display: inline-block;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"
                            valign="top">
                            <!-- BEGIN INDIVIDUAL COLUMNS // -->
                            <!--[if gte mso 9]>
                            <table align="center" border="0" cellspacing="0" cellpadding="0"
                                   style="width:600px;" width="600">
                                <tr>
                                    <td align="center" valign="top" style="width:200px;" width="200">
                            <![endif]-->
                            <div style="display:inline-block; vertical-align:top; width:197px;"
                                 class="upperColumnWidth">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                       class="threeColumnsContainer"
                                       style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 197px;">
                                    <tbody>
                                    <tr>
                                        <td valign="top" class="upperLeftColumnContainer"
                                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                   class="mcnCaptionBlock"
                                                   style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <tbody class="mcnCaptionBlockOuter">
                                                <tr>
                                                    <td class="mcnCaptionBlockInner" valign="top"
                                                        style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                        <table align="left" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               class="mcnCaptionBottomContent" width="false"
                                                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="mcnCaptionBottomImageContent"
                                                                    align="left" valign="top"
                                                                    style="padding: 0 9px 9px 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                                    <a href="<?php echo get_permalink(); ?>"
                                                                       title="" class="" target="_blank"
                                                                       style="word-wrap: break-word;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                                                        <?php if ( isset( $theme_options['theme_thumbnails'] ) ) { ?>

                                                                            <img
                                                                                src="<?php echo newsletter_get_post_image( $post->ID ); ?>"
                                                                                width="161"
                                                                                style="max-width: 163px;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;"
                                                                                class="mcnImage">
                                                                        <?php } ?>
                                                                    </a>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="mcnTextContent" valign="top"
                                                                    style="padding: 0 9px 0 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;"
                                                                    width="161">
                                                                    <a href="<?php echo get_permalink(); ?>"
                                                                       target="_blank"
                                                                       style="word-wrap: break-word;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #6DC6DD;font-weight: normal;text-decoration: underline;"><?php the_title(); ?></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>


                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!--[if gte mso 9]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                        <?php if ( $y == 2 || count( $posts ) == $i - 1 ) { ?>
                            </tr>
                            </table>
                            <!-- // END INDIVIDUAL COLUMNS -->
                            </td>
                            </tr>
                        <?php }
                        $y == 2 ? $y = 0 : $y ++;
                    }
                    ?>
                    <!-- // END 3 COLUMNS -->


                    <!-- social -->
                    <tr>
                        <td align="center" valign="top" id="templateUpperColumns"
                            style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                            <?php
                            include WP_CONTENT_DIR . '/extensions/newsletter/emails/themes/unicornbooty/footer.php'; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--[if gte mso 9]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        </tbody>
    </table>
</center>


</body>
</html>