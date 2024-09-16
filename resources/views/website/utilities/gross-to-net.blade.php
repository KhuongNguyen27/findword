@extends('website.layouts.master')
@section('content')
<style>
    span.logo-trending {
        margin-right: 0px !important;
    }

    #main {
        background: #e5e5e5;
        padding: 16px 0;
    }

    .box-white {
        background: #fff;
        border-radius: 8px;
        box-shadow: -1px 1px 6px rgba(0, 0, 0, .05);
        margin-bottom: 16px;
        overflow: hidden;
        padding: 16px;
    }

    .box-white .title {
        color: #28c1bc;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 28px;
        margin: 0 0 16px;
    }

    .select-rule {
        align-items: center;
        display: flex;
        gap: 16px;
        margin: 16px 0;
    }

    .select-rule label {
        color: #263a4d;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        letter-spacing: .175px;
        line-height: 22px;
        margin: 0;
    }

    .select-rule .list-option {
        align-items: center;
        display: flex;
        gap: 16px;
    }

    .select-rule .list-option .input-radio {
        align-items: flex-start;
        border: 1px solid #e6e7e8;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 4px 8px;
    }

    .custom-radio-circle-outline input[type=radio] {
        display: none;
    }

    .select-rule .list-option .input-radio label span {
        color: #7f878f;
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        letter-spacing: .175px;
        line-height: 22px;
        text-align: center;
    }

    .select-rule .list-option .input-radio:has(input[type=radio]:checked) {
        border: 1px solid #28c1bc;
    }

    .select-rule .list-option .input-radio {
        align-items: flex-start;
        border: 1px solid #e6e7e8;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 4px 8px;
    }

    .box-white .text-muted-content {
        color: #7f878f;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
    }

    .box-white .text-muted-content p.lh-20 {
        line-height: 20px;
        margin-bottom: 12px !important;
    }

    .box-white .text-muted-content .text-highlight {
        text-decoration: underline;
    }

    .salary-calculate .list-salary {
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 5px;
        justify-content: space-between;
        padding: 16px;
    }

    .d-flex {
        display: flex !important;
    }

    .salary-calculate .list-salary p {
        color: #333;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
    }

    .text-green {
        color: #28c1bc !important;
        font-size: 15px;
        font-style: normal;
        line-height: 20px;
    }

    .input-salary {
        margin-top: 16px;
    }

    .gap-47px {
        gap: 47px;
    }

    .input-salary label {
        color: #000;
        font-size: 15px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }

    .input-salary .input-data {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 3px;
        height: 40px;
    }

    .input-data {
        align-items: center;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 3px;
        box-sizing: border-box;
        display: flex;
        display: inline-flex;
        min-width: 300px;
        padding: 10px 16px;
        position: relative;
    }

    .input-data .icon {
        color: #28c1bc;
    }

    .input-data .caption,
    .input-data .icon {

        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        line-height: 16px;
        z-index: 2;
    }

    .input-data input {
        border: 1px solid transparent;
        border-radius: 3px;
        height: 100%;
        left: 0;
        padding-left: 40px;
        padding-right: 60px;
        position: absolute;
        text-align: right;
        width: 100%;
    }

    .input-data .caption,
    .input-data .icon {
        color: #ccc;
        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        line-height: 16px;
        z-index: 2;
    }

    .input-data .caption {
        margin-left: auto;
    }

    .mb-14 {
        margin-bottom: 14px !important;
    }

    .bao-hiem label.title {
        color: #000;
        font-weight: 500;
    }

    .bao-hiem label.title,
    .bao-hiem span {
        font-size: 15px;
        font-style: normal;
        line-height: 20px;
    }

    div .radio-inline {
        align-items: center;
        display: inline-flex;
        padding-left: 24px;
        position: relative;
    }

    .input-salary label {
        color: #000;
        font-size: 15px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }
    .bao-hiem label.title, .bao-hiem span {
    font-size: 15px;
    font-style: normal;
    line-height: 20px;
}
div input[type=radio]:checked~.icon-radio {
    border-color: #28c1bc;
}
div .radio-inline {
    align-items: center;
    display: inline-flex;
    padding-left: 24px;
    position: relative;
}
div input[type=radio]~.icon-radio {
    background-color: #fff;
    border: 1px solid #777;
    border-radius: 50%;
    box-sizing: border-box;
    display: inline-block;
    height: 16px;
    left: 0;
    margin-right: 10px;
    position: absolute;
    width: 16px;
}

.input-salary .input-data {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 3px;
    height: 40px;
}
.input-data {
    align-items: center;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 3px;
    box-sizing: border-box;
    display: flex;
    display: inline-flex;
    min-width: 300px;
    padding: 10px 16px;
    position: relative;
}
.input-data .caption, .input-data .icon {
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 16px;
    z-index: 2;
}
.input-data .caption, .input-data .icon {
    color: #ccc;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 16px;
    z-index: 2;
}
.input-data .caption {
    margin-left: auto;
}
.region .title {
    color: #000;
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px;
}
.new {
    color: #de4637!important;
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px;
}
.region .label-input label {
    color: #333;
    padding-right: 40px;
}
div .radio-inline {
    align-items: center;
    display: inline-flex;
    padding-left: 24px;
    position: relative;
}
div input[type=radio]~.icon-radio {
    background-color: #fff;
    border: 1px solid #777;
    border-radius: 50%;
    box-sizing: border-box;
    display: inline-block;
    height: 16px;
    left: 0;
    margin-right: 10px;
    position: absolute;
    width: 16px;
}
element.style {
    margin-top: 20px;
}
#salary-page .btn {
    background: #28c1bc;
    border-radius: 3px;
    color: #fff;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    margin-right: 10px;
    padding: 8px 24px;
}
#salary-page .btn:last-child {
    background: #fff;
    border-color: #28c1bc;
    color: #28c1bc;
}
#salary-page .btn {
    background: #28c1bc;
    border-radius: 3px;
    color: #fff;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    margin-right: 10px;
    padding: 8px 24px;
}
.btn {
    display: inline-block;
    margin-bottom: 0;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
}

.section-faq {
    padding: 20px 14px;
}
.box-white {
    background: #fff;
    border-radius: 8px;
    box-shadow: -1px 1px 6px rgba(0,0,0,.05);
    margin-bottom: 16px;
    overflow: hidden;
    padding: 16px;
}
.section-faq__title {
    color: #212f3f;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 32px;
    margin: 0 0 10px;
    padding: 0 10px;
}
.section-faq .panel-wrapper {
    border: unset;
}
.section-faq .panel-wrapper .panel__item {
    background: #fff;
    border-bottom: 1px solid #f4f5f5;
    margin: 0;
    padding: 10px;
}
.collapse.in {
    display: block;
}
.section-faq .panel-wrapper .panel__content {
    color: #4d5965;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px;
    margin: 12px 0;
}
.align-items-center {
    align-items: center!important;
}
.d-flex {
    display: flex!important;
}
.section-faq .panel-wrapper .panel__title {
    color: #28c1bc;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 24px;
}
.section-faq .panel-wrapper .panel__wrapper-title .btn-icon-plus {
    border: 1px solid #d3d5d9;
    display: none;
}
.section-faq .panel-wrapper .panel__wrapper-title .btn-icon {
    align-items: center;
    background: #fff;
    border-radius: 24px;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    height: 24px;
    justify-content: center;
    line-height: 16px;
    width: 24px;
}
.box-white {
    background: #fff;
    border-radius: 8px;
    box-shadow: -1px 1px 6px rgba(0,0,0,.05);
    margin-bottom: 16px;
    overflow: hidden;
    padding: 16px;
}
.label-bell {
    background: #28c1bc;
    border-radius: 20px;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    line-height: 28px;
    margin-bottom: 16px;
    padding: 2px 12px;
}
.label {
    color: #fff;
    text-align: center;
    vertical-align: baseline;
    white-space: nowrap;
}
.new-discussion p, .new-notification p {
    color: #172530;
    font-size: 14px;
    font-style: normal;
    line-height: 26px;
}
.hover-green, .hover-green:active, .hover-green:focus, .hover-green:hover, .hover-primary:active, .hover-primary:focus, .hover-primary:hover, .text-highlight:active, .text-highlight:focus, .text-highlight:hover {
    color: #28c1bc!important;
}
.hover-green {
    font-weight: 400;
    text-decoration: underline;
}
element.style {
     margin-bottom: 20px; 
}
.fb_iframe_widget {
    display: inline-block;
    position: relative;
}
.fb_iframe_widget span {
    display: inline-block;
    position: relative;
    text-align: justify;
}
.fb_iframe_widget iframe {
    position: absolute;
}
element.style {
    line-height: 28px;
    font-family: Inter;
    text-align: justify;
}
.page h2 {
    margin-bottom: 16px;
}
.page p {
    margin-bottom: 10px!important;
}
b, strong {
    font-weight: 700;
}
.related .title {
    border-bottom: 1px solid #eee;
    display: flex;
    padding-bottom: 16px;
}
.box-white .title {
    color: #28c1bc;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    margin: 0 0 16px;
}
.related ul {
    list-style: none;
    margin-left: 0;
    padding-left: 0;
}
.related ul li {
    padding-bottom: 16px;
}

#intro-cv-job.no-padding {
    padding: 0!important;
}
#intro-cv-job {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 16px 0 rgba(1,18,34,.04);
    font-family: Inter,sans-serif;
    font-style: normal;
    overflow: hidden;
}
#intro-cv-job.no-padding .content {
    padding: 16px 20px;
    text-align: center;
}
#intro-cv-job.no-padding .content h3 {
    color: #212f3f;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    letter-spacing: -.01em;
    line-height: 24px;
    margin: 0;
    text-align: left;
}
#intro-cv-job.no-padding .content__detail {
    margin: 12px 0 16px;
    text-align: left;
}
#intro-cv-job.no-padding .content__detail p {
    display: flex;
    gap: 5.33px;
    margin: 5px 0 0;
}
#intro-cv-job.no-padding .content__detail p i {
    color: #28c1bc;
}
#intro-cv-job.no-padding .content__detail p small {
    color: #212f3f;
    font-size: 13px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px;
}
#intro-cv-job.no-padding .content__detail p small {
    color: #212f3f;
    font-size: 13px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px;
}
#intro-cv-job.no-padding .content .bottom-buttons .btn.btn-create-cv, #intro-cv-job.no-padding .content .bottom-buttons .btn.btn-find-job {
    align-items: center;
    display: flex;
    font-size: 15px;
    font-weight: 500;
    height: 40px;
    justify-content: center;
    letter-spacing: 0;
    line-height: 20px;
    padding: 0;
}
#intro-cv-job.no-padding .content .bottom-buttons .btn.btn-create-cv {
    background: #28c1bc;
    margin: unset;
    width: auto;
}
#intro-cv-job.no-padding .content .bottom-buttons .btn {
    border-radius: 30px;
    color: #fff;
    font-style: normal;

}
#intro-cv-job.no-padding .content .bottom-buttons .btn.btn-find-job {
    background: #e5f7ed;
    border: none;
    color: #28c1bc;
}
#intro-cv-job.no-padding .content .bottom-buttons .btn.btn-create-cv, #intro-cv-job.no-padding .content .bottom-buttons .btn.btn-find-job {
    align-items: center;
    display: flex;
    font-size: 15px;
    font-weight: 500;
    height: 40px;
    justify-content: center;
    letter-spacing: 0;
    line-height: 20px;
    padding: 0;
}
#intro-cv-job.no-padding .content .bottom-buttons {
    display: grid;
    grid-template-columns: repeat(2,1fr);
}
#box-share-article {
    background-color: #fff;
    border-radius: 5px;
    padding: 16px;
}
#box-share-article h3 {
    font-size: 18px;
    font-weight: 700;
}
#box-share-article p {
    font-size: 14px;
    line-height: 1.6em;
    margin-bottom: 10px;
    margin-top: 1.4em;
    text-align: justify;
}
#box-share-article .box-copy {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
}
#box-share-article .box-copy .url-copy {
    background: #fafafa;
    border-radius: 5px;
    overflow: hidden!important;
    padding: 10px 14px;
    text-overflow: ellipsis!important;
    white-space: nowrap!important;
    width: 86%;
}
#box-share-article .box-copy .btn-copy {
    width: 11%;
}
#box-share-article .box-copy .btn-copy button {
    background: #f2fbf6;
    border: none;
    border-radius: 5px;
    height: 40px;
    width: 40px;
}
#box-share-article .box-copy .btn-copy button i {
    color: #28c1bc;
    font-size: 18px;
}
#box-share-article .box-share a {
    margin-right: 16px;
}
img {
    vertical-align: middle;
}
.box-share a img {
    width: 40px;
}
.related ul li a {
    color: #333;
    font-size: 15px;
    font-weight: 400;
    line-height: 20px;
}
</style>
<section class="banner-section pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="title-box">
                        <h1>Tính lương GROSS - NET</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Section-->


<div id="main">
    <div id="salary-page">
        <div class="container">
         <div class="row">
            <div class="col-md-8 col-sm-8">
                <div id="calculate-salary-section" class="box-white">
                    <h1 class="title">Công cụ tính lương Gross sang Net và ngược lại [Chuẩn 2024]</h1>
                    <div class="select-rule"><label for="">
                            Áp dụng quy định:
                        </label>
                        <div class="list-option">
                            <div class="custom-radio-circle-outline input-radio"><input id="old-value" type="radio" value="old" name="selectRule"> <label for="old-value"><span class="input-radio_label">
                                        Từ 01/07/2023 - 30/06/2024
                                    </span></label></div>
                            <div class="custom-radio-circle-outline input-radio"><input id="new-value" type="radio" value="new" name="selectRule" checked="checked"> <label for="new-value"><span class="input-radio_label">
                                        Từ 01/07/2024 (Mới nhất)
                                    </span></label></div>
                        </div>
                    </div>
                    <div class="text-muted-content">
                        <p class="lh-20">
                            Áp dụng mức lương cơ sở mới nhất có hiệu lực từ ngày 01/07/2024 (Theo Nghị định số 73/2024/NĐ-CP)

                        </p>
                        <p class="lh-20">
                            Áp dụng
                            <a href="#" class="text-highlight">mức lương
                                tối thiểu vùng</a>
                            mới nhất có hiệu lực từ ngày 01/07/2024 (Theo Nghị định 74/2024/NĐ-CP)
                        </p>
                        <p class="lh-20">
                            Áp dụng mức giảm trừ gia cảnh mới nhất 11 triệu đồng/tháng (132 triệu đồng/năm) với nguời nộp
                            thuế và 4,4 triệu đồng/tháng với mỗi người phụ thuộc (Theo Nghị quyết số 954/2020/UBTVQH14)
                        </p>
                    </div>
                    <form action="" id="salary-from">
                        <div id="salary-calculate-options" class="mb-12px">
                            <div class="salary-calculate">
                                <div class="d-flex list-salary">
                                    <div>
                                        <p class="mb-8">Lương cơ sở:</p> <span class="text-green">2,340,000đ</span>
                                    </div>
                                    <div>
                                        <p class="mb-8">Giảm trừ gia cảnh bản thân:</p> <span class="text-green">11,000,000đ</span>
                                    </div>
                                    <div>
                                        <p class="mb-8">Người phụ thuộc:</p> <span class="text-green">4,400,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-salary mb-12px">
                            <div class="d-flex gap-47px mb-24">
                                <div class="w-50 d-flex flex-lg-column"><label for="" class="mb-16 other">Thu Nhập:</label>
                                    <div class="input-data"><span class="icon"><i class="fa-solid fa-dollar-sign"></i></span> <input type="text" name="luong" value="" class="border-hover" fdprocessedid="mh1i9"> <span class="caption">(VNĐ)</span></div>
                                </div>
                                <div class="w-50 d-flex flex-lg-column"><label for="" class="mb-16 other">Số người phụ thuộc:</label>
                                    <div class="input-data"><span class="icon"><i class="fa-solid fa-user-group"></i></span> <input type="text" name="nguoiPhuThuoc" value="" class="border-hover" fdprocessedid="wjvx7c"> <span class="caption">(Người)</span></div>
                                </div>
                            </div>
                            <div class="bao-hiem d-flex flex-lg-column mb-14"><label for="" class="title mb-6">Mức lương đóng bảo hiểm:</label>
                                <div class="d-flex items-center gap-47px cvo-justify-between"><label class="radio-inline  mb-0"><input type="radio" name="dongBaoHiem" value="trenChinhThuc" checked="checked"> <span>Trên lương chính thức</span> <span class="icon-radio"></span></label>
                                    <div class="d-flex align-items-center "><label class="radio-inline other"><input type="radio" name="dongBaoHiem" value="khac"> <span class="icon-radio"></span> <span>Khác:</span></label>
                                        <div class="input-data"><span class="icon"><i class="fa-solid fa-dollar-sign"></i></span> <input type="text" name="luongDongBaoHiem" class="border-hover" fdprocessedid="5nkf1r"> <span class="caption">(VNĐ)</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="region">
                                <p class="mb-16 "><strong class="title">Vùng: </strong> <a href="#" class="small new">(Giải
                                        thích)</a></p>
                                <div class="label-input"><label class="radio-inline"><input type="radio" name="vung" value="1" checked="checked"> I
                                        <span class="icon-radio"></span></label> <label class="radio-inline"><input type="radio" name="vung" value="2"> II
                                        <span class="icon-radio"></span></label> <label class="radio-inline"><input type="radio" name="vung" value="3"> III
                                        <span class="icon-radio"></span></label> <label class="radio-inline"><input type="radio" name="vung" value="4"> IV
                                        <span class="icon-radio"></span></label></div>
                            </div>
                            <div class="d-flex"></div>
                        </div>
                    </form>
                    <div class="text-center" style="margin-top: 20px;"><a href="#" class="btn btn-topcv-primary btn-primary-hover">GROSS <i class="fa-solid fa-arrow-right"></i> NET</a> <a href="#" class="btn btn-topcv-primary btn-secondary-hover">NET <i class="fa-solid fa-arrow-right"></i> GROSS</a></div>
                    <!---->
                    <!---->
                </div>
                <div class="box-white section-faq">
                    <h2 class="section-faq__title">Các câu hỏi thường gặp (FAQs)</h2>
                    <div id="accordion" role="tablist" aria-multiselectable="true" class=" panel-wrapper">
                        <div class="panel__item panel">
                            <div role="tab" id="headingOne">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapseOne" class="panel__wrapper-title d-flex justify-content-between align-items-center ">
                                    <h3 class="panel__title"> Lương Gross là gì?</h3> <button class="btn-icon btn-icon-plus"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus" fdprocessedid="lj4yub"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse1" role="tabpanel" aria-labelledby="headingOne" class="collapse in">
                                <div class="panel__content">
                                    <p>Lương Gross là tổng số tiền mà người lao động nhận được trước khi trừ các khoản thuế,
                                        bảo hiểm, phụ cấp và các chi phí khác. Đây là số tiền thường được đưa ra khi đàm
                                        phán về
                                        mức lương và được thông báo trong hợp đồng lao động.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="headingTwo">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapseTwo" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title"> Lương Net là gì?
                                    </h3> <button class="btn-icon btn-icon-plus" fdprocessedid="g8c32i"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse2" role="tabpanel" aria-labelledby="headingTwo" class="collapse">
                                <div class="panel__content">
                                    <p>Lương Net là lương thực nhận của người lao động sau khi đã trừ hết các khoản bảo
                                        hiểm,
                                        thuế thu nhập cá nhân và các chi phí khấu trừ khác. Lương Net sẽ thấp hơn lương
                                        Gross do
                                        phải trừ đi các khoản thuế phí.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading3">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title"> Công thức tính lương Gross là gì?
                                    </h3> <button class="btn-icon btn-icon-plus" fdprocessedid="fgu0u"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse3" role="tabpanel" aria-labelledby="heading3" class="collapse">
                                <div class="panel__content">
                                    <div style="text-align: center; color: rgb(0, 177, 79); font-weight: 500;">
                                        <p><span>Lương Gross = Lương cơ bản + Thưởng + Thuế thu nhập cá nhân + Bảo hiểm xã
                                                hội +
                                                Bảo hiểm
                                                y tế + Bảo hiểm thất nghiệp + Các khoản chi phí khác</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading4">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title">Công thức tính lương Net là gì?
                                    </h3> <button class="btn-icon btn-icon-plus" fdprocessedid="px4kwn"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse4" role="tabpanel" aria-labelledby="heading4" class="collapse">
                                <div class="panel__content">
                                    <div style="text-align: center; color: rgb(0, 177, 79); font-weight: 500;">
                                        <p><span>Lương Net = Tổng thu nhập - (Thuế thu nhập cá nhân + Bảo hiểm xã hội + Bảo
                                                hiểm y
                                                tế +
                                                Bảo hiểm thất nghiệp + Các khoản khấu trừ khác)</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading5">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title">Cách tính lương Gross sang Net?</h3> <button class="btn-icon btn-icon-plus" fdprocessedid="thp7"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse5" role="tabpanel" aria-labelledby="heading5" class="collapse">
                                <div class="panel__content">
                                    <p>Sau khi trừ đi các khoản phí và thuế trên lương Gross, ta sẽ thu được số tiền lương
                                        Net.
                                        Công thức chung để tính lương Gross sang Net là:</p> <br>
                                    <div style="text-align: center; color: rgb(0, 177, 79); font-weight: 500;">
                                        <p><span>Lương Net = Lương Gross - (Thuế thu nhập cá nhân + Bảo hiểm xã hội + Bảo
                                                hiểm y
                                                tế + Bảo hiểm thất nghiệp + Các khoản khấu trừ khác)
                                            </span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading6">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title"> Cách quy đổi lương Net sang Gross?
                                    </h3> <button class="btn-icon btn-icon-plus" fdprocessedid="z8zy3d"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse6" role="tabpanel" aria-labelledby="heading6" class="collapse">
                                <div class="panel__content">
                                    <p>Để quy đổi lương Net sang lương Gross, ta cần tính toán lại các khoản phí và thuế đã
                                        bị
                                        trừ đi từ lương Gross. Công thức quy đổi từ lương Net sang lương Gross như sau:</p> <br>
                                    <div style="text-align: center; color: rgb(0, 177, 79); font-weight: 500;">
                                        <p><span>Lương Gross = Lương Net + Thuế thu nhập cá nhân + Bảo hiểm xã hội + Bảo
                                                hiểm y tế
                                                + Bảo hiểm thất nghiệp + Các khoản chi phí khác
                                            </span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading7">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title">Lương Net có bao gồm thuế thu nhập cá nhân không?
                                    </h3> <button class="btn-icon btn-icon-plus" fdprocessedid="y1uegi"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse7" role="tabpanel" aria-labelledby="heading7" class="collapse">
                                <div class="panel__content">
                                    <p>Không, lương Net không bao gồm thuế thu nhập cá nhân. Thuế TNCN sẽ được trừ trực tiếp
                                        từ
                                        mức lương Gross, không được tính vào lương Net.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel__item panel">
                            <div role="tab" id="heading8">
                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="true" aria-controls="collapse8" class="panel__wrapper-title d-flex justify-content-between align-items-center collapsed">
                                    <h3 class="panel__title">Nên deal lương Gross hay Net?</h3> <button class="btn-icon btn-icon-plus" fdprocessedid="08r5h"><i class="fa fa-plus"></i></button> <button class="btn-icon btn-icon-minus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="collapse8" role="tabpanel" aria-labelledby="heading8" class="collapse ">
                                <div class="panel__content">
                                    <p>Bạn nên deal lương Gross để nắm rõ về các khoản phải đóng hàng tháng như: BHXH, BHYT,
                                        BHTN, thuế TNCN và quỹ công đoàn (nếu có). Tuy nhiên cũng cần hiểu rằng, dù bạn đàm
                                        phán
                                        với nhà tuyển dụng bằng loại lương nào thì nhà tuyển dụng cũng sẽ tính toán để số
                                        tiền
                                        phải trả cho bạn tương đương nhau.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-white">
                    <div class="new-notification"><span class="label label-bell"><i class="fa-solid fa-bell"></i> Thông báo mới nhất</span>
                        <p style="margin-bottom: 20px;">
                            Theo <a href="https://baochinhphu.vn/tang-luong-co-so-len-muc-234-trieu-dong-thang-tu-01-7-2024-102240701113637498.htm" target="_blank" rel="nofollow" class="hover-green"><strong>Nghị định 73/2024/NĐ-CP</strong></a> quy định mức lương cơ sở và chế độ tiền thưởng đối với cán bộ, công chức, viên chức và lực lượng vũ trang, <strong>mức lương cơ sở từ ngày 01/07/2024 là 2,340,000 đồng/tháng</strong>.
                        </p>
                        <div style="margin-bottom: 20px;">
                            <p style="margin-bottom: 8px;">
                                Trong đó, mức lương cơ sở được sử dụng làm căn cứ:
                            </p>
                            <ul>
                                <li>Tính mức lương trong các bảng lương, mức phụ cấp và thực hiện các chế độ khác theo quy định của pháp luật đối với các đối tượng quy định tại Điều 2 Nghị định này;</li>
                                <li>Tính mức hoạt động phí, sinh hoạt phí theo quy định của pháp luật;</li>
                                <li>Tính các khoản trích và các chế độ được hưởng theo mức lương cơ sở.</li>
                            </ul>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p style="margin-bottom: 8px;">
                                Bên cạnh đó, căn cứ theo <a href="https://baochinhphu.vn/tu-1-7-2024-nguoi-lao-dong-lam-viec-theo-hop-dong-duoc-ap-dung-muc-luong-toi-thieu-vung-moi-10224070111530418.htm" target="_blank" rel="nofollow" class="hover-green"><strong>Nghị định 74/2024/NĐ-CP</strong></a>, từ ngày 01/07/2024, mức lương tối thiểu vùng được điều chỉnh như sau:
                            </p>
                            <ul>
                                <li>Vùng I: Từ 4,680,000 đồng/tháng lên 4,960,000 đồng/tháng;</li>
                                <li>Vùng II: Từ 4,160,000 đồng/tháng lên 4,410,000 đồng/tháng;</li>
                                <li>Vùng III: Từ 3,640,000 đồng/tháng lên 3,860,000 đồng/tháng;</li>
                                <li>Vùng IV: Từ 3,250,000 đồng/tháng lên 3,450,000 đồng/tháng.</li>
                            </ul>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p style="margin-bottom: 8px;">
                                Mức lương tối thiểu vùng theo giờ cũng được điều chỉnh tương ứng, cụ thể:
                            </p>
                            <ul>
                                <li>Vùng I: Từ 22,500 đồng/giờ lên 23,800 đồng/giờ;</li>
                                <li>Vùng II: Từ 20,000 đồng/giờ lên 21,200 đồng/giờ;</li>
                                <li>Vùng III: Từ 17,500 đồng/giờ lên 18,600 đồng/giờ;</li>
                                <li>Vùng IV từ 15,600 đồng/giờ lên 16,600 đồng/giờ.</li>
                            </ul>
                        </div>
                        <p>
                            Danh mục địa bàn vùng I, vùng II, vùng III, vùng IV được điều chỉnh, bấm <a href="#" data-toggle="modal" data-target="#modal-salary-newest-detail" class="hover-green"><strong>vào đây</strong></a> để xem chi tiết địa bàn áp dụng.
                        </p>
                    </div>
                </div>
                <div class="box-white">
                    <div style="overflow: hidden;">
                        <div style="clear: both; margin-bottom: 9px;">
                            <div data-href="#" class="fb-send"></div>
                            <div data-href="#" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true" class="fb-like facebook-button fb_iframe_widget" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=recommend&amp;app_id=1478418029113221&amp;container_width=688&amp;href=https%3A%2F%2Fwww.topcv.vn%2Ftinh-luong-gross-net&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true"><span style="vertical-align: bottom; width: 195px; height: 28px;"><iframe name="ffd17fe6a6166d4a3" width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v12.0/plugins/like.php?action=recommend&amp;app_id=1478418029113221&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df5776a308472d0d1f%26domain%3Dwww.topcv.vn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fwww.topcv.vn%252Ff6502812269158939%26relation%3Dparent.parent&amp;container_width=688&amp;href=https%3A%2F%2Fwww.topcv.vn%2Ftinh-luong-gross-net&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true" style="border: none; visibility: visible; width: 195px; height: 28px;" class=""></iframe></span></div>
                        </div>
                    </div>
                    <div class="page" style="line-height: 28px; font-family: Inter; text-align: justify;">
                        <h2 style="font-size: 23px; margin-top: 0px; text-align: start;">Cách tính lương Gross và lương Net</h2>
                        <p><strong style="font-style: italic;">Lương Net và lương Gross đều là mức lương được thỏa thuận giữa người lao động
                                và nhà tuyển dụng. Tuy
                                nhiên, lương Net và lương Gross có khác biệt tương đối lớn. Vậy lương Gross là gì, lương Net là gì? Mối quan
                                hệ giữa lương Gross và lương Net là gì? Tìm Việc Siêu Nhanh sẽ giải đáp dưới đây.</strong></p>
                        <p><strong style="color: red;">Lương Gross</strong> <i>(hay còn gọi là lương gộp/lương trước thuế)</i> là tổng thu
                            nhập của
                            người lao động, bao gồm cả thuế, các khoản đóng bảo hiểm <i>(bảo hiểm y tế, bảo hiểm xã hội, bảo hiểm thất
                                nghiệp)</i>,
                            và các phụ cấp khác. Mức lương thực nhận của bạn thường sẽ thấp hơn mức này vì bạn phải trích ra một phần để
                            đóng bảo hiểm và nộp thuế thu nhập cá nhân.
                        </p>
                        <p><strong>Công thức tính lương Gross</strong> như sau:</p>
                        <p style="text-transform: uppercase; padding: 10px; margin: 10px 0px; text-align: center; font-size: 18px; border: 1px dashed rgb(102, 102, 102);">
                            Lương Gross = Lương cơ bản + Thưởng + Các khoản chi phí khác
                        </p>
                        <p><strong>Ví dụ</strong>: Nếu lương cơ bản của một nhân viên là 10 triệu đồng/tháng, anh ta được hưởng thêm phụ
                            cấp tiền cơm 1 triệu đồng và khoản tiền thưởng 3 triệu đồng, lương Gross của anh ta sẽ là:
                        </p>
                        <p style="text-align: center; font-size: 18px;">
                            Lương Gross = 10,000,000 + 1,000,000 + 3,000,000 = 14,000,000 đồng/tháng
                        </p>
                        <p><strong style="color: red;">Lương Net</strong> <i>(hay còn gọi là lương ròng/lương sau thuế)</i> là
                            số
                            tiền người lao động
                            thực nhận sau khi trừ các khoản thuế, bảo hiểm, giảm trừ gia cảnh, và các khoản khác <i>(nếu có)</i>. Khi đàm
                            phán
                            lương, nếu bạn muốn biết chính xác số tiền thực lĩnh thì có thể deal lương Net thay vì Gross. Vậy lương Net có
                            bao gồm thuế thu nhập cá nhân không? Thực tế thì lương Net sẽ không bao gồm thuế thu nhập cá nhân.
                        </p>
                        <p><strong>Công thức tính lương Net</strong> như sau:</p>
                        <p style="text-transform: uppercase; padding: 10px; margin: 10px 0px; text-align: center; font-size: 18px; border: 1px dashed rgb(102, 102, 102);">
                            Lương Net = Tổng thu nhập - (Thuế TNCN + BHXH + BHYT + BHTN + Các khoản khấu trừ khác)
                        </p>
                        <p>
                            Để chuyển lương Gross sang Net hoặc quy đổi lương Net sang Gross online, bạn hãy nhập mức lương Gross hoặc lương
                            Net của bản thân tại công cụ tính lương Net và Gross của Tìm Việc Siêu Nhanh phía trên để được tính toán chi tiết. Công cụ sẽ
                            tự động tính lương Gross từ lương Net hoặc ngược lại, bạn sẽ biết rõ mức lương mình sẽ nhận được.

                        </p> <strong style="color: red;">Diễn giải quan hệ giữa lương Gross và lương Net bằng công thức:
                        </strong>
                        <p style="padding: 10px; margin: 10px 0px 20px; text-align: center; font-size: 18px; border: 1px dashed rgb(102, 102, 102);">
                            LƯƠNG GROSS = LƯƠNG NET + BHXH + BHYT + BHTN + THUẾ TNCN + CHI PHÍ KHÁC
                        </p>
                        <h2 style="font-size: 23px; margin-top: 35px;">Lương Gross hay lương Net có lợi hơn cho người lao động?</h2>
                        <p>Thoạt nhìn, có thể bạn cho rằng lương Net có lợi hơn vì đó là số tiền bạn thực nhận, còn lương
                            Gross
                            thì bạn có
                            cảm giác bị mất đi một khoản khi nhận lương.</p>
                        <p>Tuy nhiên trên thực tế, dù bạn quy đổi lương Net sang Gross - hay từ Gross sang Net, thì số tiền
                            bạn
                            nhận được
                            cũng không thay đổi. Dù bạn đàm phán với nhà tuyển dụng bằng cách nào thì nhà tuyển dụng cũng sẽ tính toán để
                            chi phí phải trả cho bạn nằm trong một khoảng nhất định.</p>
                        <div style="padding: 10px; border: 1px dashed rgb(102, 102, 102); margin: 10px 0px;">
                            <p><strong>Ví dụ:</strong> Mức lương Gross là <span style="color: red;">15,000,000 VND</span>
                                sẽ tương đương với mức lương Net <span style="color: red;">13,303,750 VND</span> trong trường hợp đóng bảo
                                hiểm trên lương chính thức.</p>
                            <p>Vậy nên khi nhà tuyển dụng quyết định trả bạn mức lương Gross là <span style="color: red;">15,000,000
                                    VND</span>,
                                nếu bạn đàm phán mức lương Net thì lương của bạn sẽ là <span style="color: red;">13,303,750 VND</span>
                                và ngược lại.</p>
                            Về cơ bản lương bạn nhận được vẫn không đổi dù bạn đàm phán lương Net hay Gross.
                            <i style="color: rgb(132, 133, 132); font-size: 0.9em; display: block; text-align: right;">Theo quy định mới nhất
                                (Từ 01/07/2024)</i>
                        </div>
                        <p>
                            Tuy nhiên nếu tinh ý, bạn sẽ thấy rằng khi sử dụng lương Gross mức lương bạn nhận được sẽ minh bạch hơn. Với mức
                            lương Gross bạn sẽ chủ động tính toán được mức lương Net của mình và biết được các khoản bảo hiểm, thuế mà công
                            ty đóng cho bạn, nguợc lại với lương Net có thể bạn sẽ không biết được mức bảo hiểm công ty đóng cho mình là bao
                            nhiêu.
                        </p>
                        <div style="padding: 10px; border: 1px dashed rgb(102, 102, 102); margin: 10px 0px;"><strong>Ví dụ:</strong> Mức lương Net là <span style="color: red;">13,500,000 VND</span>
                            <ul>
                                <li>Trường hợp đóng bảo hiểm trên mức lương chính thức lương Gross sẽ là <span style="color: red;">15,230,815
                                        VND</span></li>
                                <li>Trường hợp đóng bảo hiểm ở mức <span style="color: red;">5,000,000 VND</span> lương Gross sẽ là <span style="color: red;">14,156,579 VND</span></li>
                            </ul>

                            Như ví dụ trên, bạn có thể thấy cùng một mức lương Net nhưng với mức đóng bảo hiểm khác nhau mức lương Gross bạn
                            nhận được chênh nhau khá nhiều, lương Gross sẽ thể hiện chính xác quyền lợi bạn nhận được hơn là lương Net.
                            <br> <i style="color: rgb(132, 133, 132); font-size: 0.9em; display: block; text-align: right;">Theo quy định mới nhất
                                (Từ 01/07/2024)</i>
                        </div>
                        <p>
                            Vậy nên, nếu có thể bạn hãy đàm phán với nhà tuyển dụng bằng luơng Gross, còn nếu nhà tuyển dụng và bạn làm việc
                            với nhau trên lương Net thì bạn có thể hỏi rõ về mức đóng bảo hiểm mà công ty đóng cho bạn để nắm được chính xác
                            hơn quyền lợi của mình.
                        </p>
                        <p>
                            Việc nắm rõ các thông tin liên quan đến lương Gross và Net đảm bảo người lao động có thể chủ động deal lương và
                            tính toán số lương nhận được vào mỗi kỳ lương. Hãy sử dụng công cụ tính lương Gross - Net của Tìm Việc Siêu Nhanh để dễ dàng
                            quy đổi lương Gross sang Net và lương Net sang Gross nhé!
                        </p> <img id="banner-gross-net" src="{{ asset('website-assets/images/banner/BANNER_TUYENDUNGHUE_11_900x500.png') }}" alt="công cụ tính lương net sang gross, gross sang net" title="Công cụ tính lương net sang gross, gross sang net" style="cursor: pointer; max-width: 100%; display: block; margin: 20px auto 10px;">
                        <figcaption style="font-style: italic; text-align: center; font-size: 0.9em; color: rgb(102, 102, 102); margin: 5px auto 10px;">
                            Công cụ tính lương Net sang Gross, Gross sang Net chuẩn 2024 trên Tìm Việc Siêu Nhanh
                        </figcaption>
                    </div>
                    <p style="color: red;">
                        Bản quyền nội dung thuộc về Tìm Việc Siêu Nhanh.vn, được bảo vệ bởi Luật bảo vệ bản quyền tác giả <a target="_blank" href="//www.dmca.com/Protection/Status.aspx?ID=1b16a667-a95e-4730-846f-46f962522fce" style="color: red; font-weight: bold;">DMCA</a>.
                        <br>
                        Vui lòng không trích dẫn nội dung trang web khi chưa được sự cho phép của Tìm Việc Siêu Nhanh.
                    </p>
                    <div style="overflow: hidden;">
                        <div style="clear: both; margin-bottom: 12px; margin-top: 22px;">
                            <div data-href="#" class="fb-send"></div>
                            <div data-href="#" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true" class="fb-like facebook-button fb_iframe_widget" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=recommend&amp;app_id=1478418029113221&amp;container_width=688&amp;href=https%3A%2F%2Fwww.topcv.vn%2Ftinh-luong-gross-net&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true"><span style="vertical-align: bottom; width: 195px; height: 28px;"><iframe name="fa32308814cd01c99" width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v12.0/plugins/like.php?action=recommend&amp;app_id=1478418029113221&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfb0fb96bd12457d43%26domain%3Dwww.topcv.vn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fwww.topcv.vn%252Ff6502812269158939%26relation%3Dparent.parent&amp;container_width=688&amp;href=https%3A%2F%2Fwww.topcv.vn%2Ftinh-luong-gross-net&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true" style="border: none; visibility: visible; width: 195px; height: 28px;" class=""></iframe></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebar" class="col-md-4 col-sm-4">
                <div class="box box-white" style="padding: 0px;"><a href="#" target="_blank" id="link-img"><img src="{{ asset('website-assets/images/banner/BANNER_TUYENDUNG_4.png') }}" alt="" title="" class="img-responsive" style="width: 100%;"></a></div>
                <div class="box box-white related">
                    <h2 class="title title-box"><span class="icon"><i class="fa-solid fa-memo"></i></span>
                        Bài viết liên quan
                    </h2>
                    <ul>
                        <li><a href="#">Lương
                                Gross là gì? Nên deal lương Gross hay lương Net để có lợi nhất?</a></li>
                        <li><a href="#">Lương Net là gì? Cần biết gì khi
                                nhận lương Net để tránh bị thiệt?</a></li>
                        <li><a href="#">Đàm phán
                                lương: Nên và không nên hỏi gì?</a></li>
                        <li><a href="#">Lương cơ bản là gì? Cách tính
                                lương cơ bản năm 2023</a></li>
                        <li><a href="#">Lương cơ sở là gì? Mức lương cơ
                                sở đang áp dụng hiện nay</a></li>
                        <li><a href="#">Lương tháng 13 là gì? Cách
                                tính lương tháng 13</a></li>
                        <li><a href="#">Lương hưu là gì? Những điều bạn
                                cần lưu ý về lương hưu</a></li>
                    </ul>
                </div>
                <div id="corresponding_job" class="box box-white corresponding-job">
                    <h2 class="title title-box"><span class="icon"><i class="fa-solid fa-briefcase"></i></span> <span id="corresponding_job_text">
                            Việc làm tốt nhất với mức lương
                        </span></h2>
                    <div id="list_corresponding_job" class="list-job"></div>
                    <div id="list_corresponding_seemore" class="list-job corresponding-job__seemore"><a href="#" id="seemore-corresponding">
                            Xem tất cả
                        </a></div>
                </div>
                <div id="comment" class="box box-white">
                    <h2 class="title title-box"><span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        Hỗ trợ
                    </h2>
                    <p>
                        Bạn có chia sẻ hay cần tư vấn về cách tính lương <span class="text-highlight">Gross/Net?</span></p>
                    <p>
                        Hãy gửi email đề xuất tới <a href="#" class="text-highlight">#</a></p>
                </div>
                <div id="intro-cv-job" class="box box-white no-padding">
                    <div class="img-banner"><img src="{{ asset('website-assets/images/banner/BANNER_TUYENDUNGVIECLAM_3.png') }}" alt="Tao CV va tim viec - Tìm Việc Siêu Nhanh"></div>
                    <div class="content">
                        <h3 class="title">
                            Tạo CV miễn phí và tìm công việc mơ ước với Tìm Việc Siêu Nhanh
                        </h3>
                        <div class="content__detail">
                            <p><i class="fa-solid fa-circle-check"></i> <small>
                                    50+ mẫu CV "cực đẹp", chỉnh sửa dễ dàng trong 5 phút.
                                </small></p>
                            <p><i class="fa-solid fa-circle-check"></i> <small>
                                    Chuyên trang việc làm chất lượng cao
                                </small></p>
                        </div>
                        <div class="bottom-buttons"><a href="#" id="btn-seo-article-mau-cv" class="btn btn-create-cv">Tạo CV</a> <a href="#" id="btn-seo-article-viec-lam" class="btn btn-find-job" style="margin-left: 5px;">Tìm việc ngay</a></div>
                    </div>
                </div>
                <div class="box box-white" style="padding: 0px;"><a href="https://happytime.vn/tinh-nang?utm_source=topcv_banner&amp;utm_medium=sidebar-menu&amp;utm_campaign=tinh-luong-gross-net" target="_blank"><img src="{{ asset('website-assets/images/banner/TUYENDUNGHUE_BANNER_12_900x500.png') }}" alt="Happy Time" title="Happy Time" class="img-responsive" style="width: 100%;"></a></div>
                <div id="box-share-article">
                    <h3>Chia sẻ bài viết</h3>
                    <p>Sao chép đường dẫn</p>
                    <div class="box-copy">
                        <div class="url-copy">https://timviecsieunhanh.vn/cong-cu/tinh-luong-gross-net</div>
                        <div class="btn-copy"><button onclick="copyToClipboard('.url-copy')" class="btn-secondary-hover" fdprocessedid="7y8efa"><i class="fa-regular fa-copy"></i></button></div>
                    </div>
                    <p>Chia sẻ qua mạng xã hội</p>
                    <div class="box-share"><a href="#" target="_blank"><img src="https://static.topcv.vn/v4/image/job-detail/share/facebook.png" alt=""></a> <a href="#" target="_blank"><img src="https://static.topcv.vn/v4/image/job-detail/share/twitter.png" alt=""></a> <a href="#" target="_blank"><img src="https://static.topcv.vn/v4/image/job-detail/share/linkedin.png" alt=""></a></div>
                </div>
            </div>
        </div>
        </div>
        <div id="new_option_detail_modal" tabindex="-1" role="dialog" class="modal fade">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-primary"><strong>
                                Quy định tính lương mới nhất áp dụng từ 01/07/2024
                            </strong></h4>
                    </div>
                    <div class="modal-body">
                        <p class="custom-font-italic"><b>Cụ thể:</b></p>
                        <p>Lương cơ sở: <span class="text-green">2,340,000đ</span></p>
                        <p>Giảm trừ gia cảnh bản thân: <span class="text-green">11,000,000đ
                                / tháng</span></p>
                        <p>Người phụ thuộc: <span class="text-green">4,400,000đ
                                /
                                người / tháng</span></p>
                        <p>Mức lương tối thiểu vùng:</p>
                        <ul>
                            <li>Vùng I: 4,960,000 đồng/tháng</li>
                            <li>Vùng II: 4,410,000 đồng/tháng</li>
                            <li>Vùng III: 3,860,000 đồng/tháng</li>
                            <li>Vùng IV: 3,450,000 đồng/tháng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div tabindex="-1" role="dialog" id="modal-salary-detail" class="modal fade">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-primary"><strong>Mức lương tối thiểu vùng</strong></h4>
                        <p class="custom-font-italic" style="margin-bottom: 0px;">Áp dụng mức lương tối thiểu vùng mới nhất có hiệu lực từ ngày 01/07/2024</p>
                    </div>
                    <div class="modal-body">
                        <ul style="margin-top: 0px;">
                            <li>Vùng I: 4,960,000 đồng/tháng</li>
                            <li>Vùng II: 4,410,000 đồng/tháng</li>
                            <li>Vùng III: 3,860,000 đồng/tháng</li>
                            <li>Vùng IV: 3,450,000 đồng/tháng</li>
                        </ul>
                        <div>
                            <p class="text-primary"><strong>1. Vùng I, gồm các địa bàn:</strong></p>
                            <ul>
                                <li>Các quận và các huyện Gia Lâm, Đông Anh, Sóc Sơn, Thanh Trì, Thường Tín, Hoài Đức, Thạch Thất, Quốc Oai, Thanh
                                    Oai, Mê Linh, Chương Mỹ và thị xã Sơn Tây thuộc thành phố Hà Nội;</li>
                                <li>Các thành phố Hạ Long, Uông Bí, Móng Cái và các thị xã Quảng Yên, Đông Triều thuộc tỉnh Quảng Ninh;</li>
                                <li>Các quận và các huyện Thủy Nguyên, An Dương, An Lão, Vĩnh Bảo, Tiên Lãng, Cát Hải, Kiến Thụy thuộc thành phố Hải
                                    Phòng;</li>
                                <li>Thành phố Hải Dương thuộc tỉnh Hải Dương;
                                </li>
                                <li>Các quận, thành phố Thủ Đức và các huyện Củ Chi, Hóc Môn, Bình Chánh, Nhà Bè thuộc Thành phố Hồ Chí Minh;</li>
                                <li>Các thành phố Biên Hòa, Long Khánh và các huyện Nhơn Trạch, Long Thành, Vĩnh Cửu, Trảng Bom, Xuân Lộc, Thống
                                    Nhất thuộc tỉnh Đồng Nai;</li>
                                <li>Các thành phố Thủ Dầu Một, Thuận An, Dĩ An, Tân Uyên, Bến Cát và các huyện Bàu Bàng, Bắc Tân Uyên, Dầu Tiếng,
                                    Phú Giáo thuộc tỉnh Bình Dương;</li>
                                <li>Thành phố Vũng Tàu, thị xã Phú Mỹ thuộc tỉnh Bà Rịa - Vũng Tàu;</li>
                                <li>Thành phố Tân An và các huyện Đức Hòa, Bến Lức, Cần Giuộc thuộc tỉnh Long An.</li>
                            </ul>
                            <p class="text-primary"><strong>2. Vùng II, gồm các địa bàn:</strong></p>
                            <ul>
                                <li> Các huyện còn lại thuộc thành phố Hà Nội; </li>
                                <li>
                                    Thành phố Lào Cai thuộc tỉnh Lào Cai; </li>
                                <li>
                                    Các thành phố Thái Nguyên, Sông Công và Phổ Yên thuộc tỉnh Thái Nguyên; </li>
                                <li>
                                    Thành phố Hoà Bình và huyện Lương Sơn thuộc tỉnh Hòa Bình; </li>
                                <li>
                                    Thành phố Việt Trì thuộc tỉnh Phú Thọ; </li>
                                <li>
                                    Thành phố Bắc Giang, thị xã Việt Yên và huyện Yên Dũng thuộc tỉnh Bắc Giang; </li>
                                <li>
                                    Các thành phố Vĩnh Yên, Phúc Yên và các huyện Bình Xuyên, Yên Lạc thuộc tỉnh Vĩnh Phúc; </li>
                                <li>
                                    Các thành phố Bắc Ninh, Từ Sơn; các thị xã Thuận Thành, Quế Võ và các huyện Tiên Du, Yên Phong, Gia Bình, Lương
                                    Tài thuộc tỉnh Bắc Ninh; </li>
                                <li>
                                    Thành phố Hưng Yên, thị xã Mỹ Hào và các huyện Văn Lâm, Văn Giang, Yên Mỹ thuộc tỉnh Hưng Yên; </li>
                                <li>
                                    Thành phố Chí Linh, thị xã Kinh Môn và các huyện Cẩm Giàng, Bình Giang, Tứ Kỳ, Gia Lộc, Nam Sách, Kim Thành
                                    thuộc
                                    tỉnh Hải Dương; </li>
                                <li>
                                    Thành phố Cẩm Phả thuộc tỉnh Quảng Ninh; </li>
                                <li>
                                    Các huyện còn lại thuộc thành phố Hải Phòng; </li>
                                <li>
                                    Thành phố Thái Bình thuộc tỉnh Thái Bình; </li>
                                <li>
                                    Thành phố Nam Định và huyện Mỹ Lộc thuộc tỉnh Nam Định; </li>
                                <li>
                                    Thành phố Ninh Bình thuộc tỉnh Ninh Bình; </li>
                                <li>
                                    Các thành phố Thanh Hóa, Sầm Sơn và các thị xã Bỉm Sơn, Nghi Sơn thuộc tỉnh Thanh Hóa; </li>
                                <li>
                                    Thành phố Vinh, thị xã Cửa Lò và các huyện Nghi Lộc, Hưng Nguyên thuộc tỉnh Nghệ An; </li>
                                <li>
                                    Thành phố Đồng Hới thuộc tỉnh Quảng Bình; </li>
                                <li>
                                    Thành phố Huế thuộc tỉnh Thừa Thiên Huế; </li>
                                <li>
                                    Các thành phố Hội An, Tam Kỳ thuộc tỉnh Quảng Nam; </li>
                                <li>
                                    Các quận, huyện thuộc thành phố Đà Nẵng; </li>
                                <li>
                                    Các thành phố Nha Trang, Cam Ranh và thị xã Ninh Hòa thuộc tỉnh Khánh Hòa; </li>
                                <li>
                                    Các thành phố Đà Lạt, Bảo Lộc thuộc tỉnh Lâm Đồng; </li>
                                <li>
                                    Thành phố Phan Thiết thuộc tỉnh Bình Thuận; </li>
                                <li>
                                    Huyện Cần Giờ thuộc Thành phố Hồ Chí Minh; </li>
                                <li>
                                    Thành phố Tây Ninh, các thị xã Trảng Bàng, Hòa Thành và huyện Gò Dầu thuộc tỉnh Tây Ninh; </li>
                                <li>
                                    Các huyện Định Quán, Tân Phú, Cẩm Mỹ thuộc tỉnh Đồng Nai; </li>
                                <li>
                                    Thành phố Đồng Xoài, thị xã Chơn Thành và huyện Đồng Phú thuộc tỉnh Bình Phước; </li>
                                <li>
                                    Thành phố Bà Rịa thuộc tỉnh Bà Rịa - Vũng Tàu; </li>
                                <li>
                                    Các huyện Thủ Thừa, Cần Đước và thị xã Kiến Tường thuộc tỉnh Long An; </li>
                                <li>
                                    Thành phố Mỹ Tho và huyện Châu Thành thuộc tỉnh Tiền Giang; </li>
                                <li>
                                    Thành phố Bến Tre và huyện Châu Thành thuộc tỉnh Bến Tre; </li>
                                <li>
                                    Thành phố Vĩnh Long và thị xã Bình Minh thuộc tỉnh Vĩnh Long; </li>
                                <li>
                                    Các quận thuộc thành phố Cần Thơ; </li>
                                <li>
                                    Các thành phố Rạch Giá, Hà Tiên, Phú Quốc thuộc tỉnh Kiên Giang; </li>
                                <li>
                                    Các thành phố Long Xuyên, Châu Đốc thuộc tỉnh An Giang; </li>
                                <li>
                                    Thành phố Trà Vinh thuộc tỉnh Trà Vinh;
                                </li>
                                <li>
                                    Thành phố Sóc Trăng thuộc tỉnh Sóc Trăng;
                                </li>
                                <li>
                                    Thành phố Bạc Liêu thuộc tỉnh Bạc Liêu;
                                </li>
                                <li>
                                    Thành phố Cà Mau thuộc tỉnh Cà Mau.
                                </li>
                            </ul>
                            <p></p>
                            <p class="text-primary"><strong>3. Vùng III, gồm các địa bàn:</strong></p>
                            <ul>
                                <li>Các thành phố trực thuộc tỉnh còn lại (trừ các thành phố trực thuộc tỉnh nêu tại vùng I, vùng II); </li>
                                <li>Thị xã Sa Pa, huyện Bảo Thắng thuộc tỉnh Lào Cai; </li>
                                <li>Các huyện Phú Bình, Phú Lương, Đồng Hỷ, Đại Từ thuộc tỉnh Thái Nguyên; </li>
                                <li>Các huyện Hiệp Hòa, Tân Yên, Lạng Giang thuộc tỉnh Bắc Giang; </li>
                                <li>Các huyện Ninh Giang, Thanh Miện, Thanh Hà thuộc tỉnh Hải Dương; </li>
                                <li>Thị xã Phú Thọ và các huyện Phù Ninh, Lâm Thao, Thanh Ba, Tam Nông thuộc tỉnh Phú Thọ; </li>
                                <li>Các huyện Vĩnh Tường, Tam Đảo, Tam Dương, Lập Thạch, Sông Lô thuộc tỉnh Vĩnh Phúc; </li>
                                <li>Các huyện Vân Đồn, Hải Hà, Đầm Hà, Tiên Yên thuộc tỉnh Quảng Ninh; </li>
                                <li>Các huyện còn lại thuộc tỉnh Hưng Yên; </li>
                                <li>Các huyện Thái Thụy, Tiền Hải thuộc tỉnh Thái Bình; </li>
                                <li>Các huyện còn lại thuộc tỉnh Nam Định; </li>
                                <li>Thị xã Duy Tiên và huyện Kim Bảng thuộc tỉnh Hà Nam; </li>
                                <li>Các huyện Gia Viễn, Yên Khánh, Hoa Lư thuộc tỉnh Ninh Bình; </li>
                                <li>Các huyện Đông Sơn, Quảng Xương, Triệu Sơn, Thọ Xuân, Yên Định, Vĩnh Lộc, Thiệu Hóa, Hà Trung, Hậu Lộc, Nga Sơn,
                                    Hoằng Hóa, Nông Cống thuộc tỉnh Thanh Hóa; </li>
                                <li>Các huyện Quỳnh Lưu, Yên Thành, Diễn Châu, Đô Lương, Nam Đàn, Nghĩa Đàn và các thị xã Thái Hòa, Hoàng Mai thuộc
                                    tỉnh
                                    Nghệ An; </li>
                                <li>Thị xã Kỳ Anh thuộc tỉnh Hà Tĩnh; </li>
                                <li>Các thị xã Hương Thủy, Hương Trà và các huyện Phú Lộc, Phong Điền, Quảng Điền, Phú Vang thuộc tỉnh Thừa Thiên
                                    Huế;
                                </li>
                                <li>Thị xã Điện Bàn và các huyện Đại Lộc, Duy Xuyên, Núi Thành, Quế Sơn, Thăng Bình, Phú Ninh thuộc tỉnh Quảng Nam;
                                </li>
                                <li>Các huyện Bình Sơn, Sơn Tịnh thuộc tỉnh Quảng Ngãi; </li>
                                <li>Các thị xã Sông Cầu, Đông Hòa thuộc tỉnh Phú Yên; </li>
                                <li>Các huyện Ninh Hải, Thuận Bắc, Ninh Phước thuộc tỉnh Ninh Thuận; </li>
                                <li>Các huyện Cam Lâm, Diên Khánh, Vạn Ninh thuộc tỉnh Khánh Hòa; </li>
                                <li>Huyện Đăk Hà thuộc tỉnh Kon Tum; </li>
                                <li>Các huyện Đức Trọng, Di Linh thuộc tỉnh Lâm Đồng; </li>
                                <li>Thị xã La Gi và các huyện Hàm Thuận Bắc, Hàm Thuận Nam thuộc tỉnh Bình Thuận; </li>
                                <li>Các thị xã Phước Long, Bình Long và các huyện Hớn Quản, Lộc Ninh, Phú Riềng thuộc tỉnh Bình Phước; </li>
                                <li>Các huyện còn lại thuộc tỉnh Tây Ninh; </li>
                                <li>Các huyện Long Điền, Đất Đỏ, Xuyên Mộc, Châu Đức, Côn Đảo thuộc tỉnh Bà Rịa - Vũng Tàu; </li>
                                <li>Các huyện Đức Huệ, Châu Thành, Tân Trụ, Thạnh Hóa thuộc tỉnh Long An; </li>
                                <li>Thị xã Cai Lậy và các huyện Chợ Gạo, Tân Phước thuộc tỉnh Tiền Giang; </li>
                                <li>Các huyện Ba Tri, Bình Đại, Mỏ Cày Nam thuộc tỉnh Bến Tre; </li>
                                <li>Các huyện Mang Thít, Long Hồ thuộc tỉnh Vĩnh Long; </li>
                                <li>Các huyện thuộc thành phố Cần Thơ; </li>
                                <li>Các huyện Kiên Lương, Kiên Hải, Châu Thành thuộc tỉnh Kiên Giang; </li>
                                <li>Thị xã Tân Châu và các huyện Châu Phú, Châu Thành, Thoại Sơn thuộc tỉnh An Giang; </li>
                                <li>Các huyện Châu Thành, Châu Thành A thuộc tỉnh Hậu Giang; </li>
                                <li>Thị xã Duyên Hải thuộc tỉnh Trà Vinh; </li>
                                <li>Thị xã Giá Rai và huyện Hòa Bình thuộc tỉnh Bạc Liêu; </li>
                                <li>Các thị xã Vĩnh Châu, Ngã Năm thuộc tỉnh Sóc Trăng; </li>
                                <li>Các huyện Năm Căn, Cái Nước, U Minh, Trần Văn Thời thuộc tỉnh Cà Mau; </li>
                                <li>Các huyện Lệ Thủy, Quảng Ninh, Bố Trạch, Quảng Trạch và thị xã Ba Đồn thuộc tỉnh Quảng Bình.</li>
                            </ul>
                            <p class="text-primary"><strong>4. Vùng IV, gồm các địa bàn còn lại</strong></p>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Đóng lại</button></div>
                </div>
            </div>
        </div>
        <div tabindex="-1" role="dialog" id="modal-salary-newest-detail" class="modal fade">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-primary"><strong>Mức lương tối thiểu vùng</strong></h4>
                        <p class="custom-font-italic" style="margin-bottom: 0px;">Áp dụng mức lương tối thiểu vùng mới nhất có hiệu lực từ ngày 01/07/2024</p>
                    </div>
                    <div class="modal-body">
                        <ul style="margin-top: 0px;">
                            <li>Vùng I: 4,960,000 đồng/tháng</li>
                            <li>Vùng II: 4,410,000 đồng/tháng</li>
                            <li>Vùng III: 3,860,000 đồng/tháng</li>
                            <li>Vùng IV: 3,450,000 đồng/tháng</li>
                        </ul>
                        <div>
                            <p class="text-primary"><strong>1. Vùng I, gồm các địa bàn:</strong></p>
                            <ul>
                                <li>Các quận và các huyện Gia Lâm, Đông Anh, Sóc Sơn, Thanh Trì, Thường Tín, Hoài Đức, Thạch Thất, Quốc Oai, Thanh
                                    Oai, Mê Linh, Chương Mỹ và thị xã Sơn Tây thuộc thành phố Hà Nội;</li>
                                <li>Các thành phố Hạ Long, Uông Bí, Móng Cái và các thị xã Quảng Yên, Đông Triều thuộc tỉnh Quảng Ninh;</li>
                                <li>Các quận và các huyện Thủy Nguyên, An Dương, An Lão, Vĩnh Bảo, Tiên Lãng, Cát Hải, Kiến Thụy thuộc thành phố Hải
                                    Phòng;</li>
                                <li>Thành phố Hải Dương thuộc tỉnh Hải Dương;
                                </li>
                                <li>Các quận, thành phố Thủ Đức và các huyện Củ Chi, Hóc Môn, Bình Chánh, Nhà Bè thuộc Thành phố Hồ Chí Minh;</li>
                                <li>Các thành phố Biên Hòa, Long Khánh và các huyện Nhơn Trạch, Long Thành, Vĩnh Cửu, Trảng Bom, Xuân Lộc, Thống
                                    Nhất thuộc tỉnh Đồng Nai;</li>
                                <li>Các thành phố Thủ Dầu Một, Thuận An, Dĩ An, Tân Uyên, Bến Cát và các huyện Bàu Bàng, Bắc Tân Uyên, Dầu Tiếng,
                                    Phú Giáo thuộc tỉnh Bình Dương;</li>
                                <li>Thành phố Vũng Tàu, thị xã Phú Mỹ thuộc tỉnh Bà Rịa - Vũng Tàu;</li>
                                <li>Thành phố Tân An và các huyện Đức Hòa, Bến Lức, Cần Giuộc thuộc tỉnh Long An.</li>
                            </ul>
                            <p class="text-primary"><strong>2. Vùng II, gồm các địa bàn:</strong></p>
                            <ul>
                                <li> Các huyện còn lại thuộc thành phố Hà Nội; </li>
                                <li>
                                    Thành phố Lào Cai thuộc tỉnh Lào Cai; </li>
                                <li>
                                    Các thành phố Thái Nguyên, Sông Công và Phổ Yên thuộc tỉnh Thái Nguyên; </li>
                                <li>
                                    Thành phố Hoà Bình và huyện Lương Sơn thuộc tỉnh Hòa Bình; </li>
                                <li>
                                    Thành phố Việt Trì thuộc tỉnh Phú Thọ; </li>
                                <li>
                                    Thành phố Bắc Giang, thị xã Việt Yên và huyện Yên Dũng thuộc tỉnh Bắc Giang; </li>
                                <li>
                                    Các thành phố Vĩnh Yên, Phúc Yên và các huyện Bình Xuyên, Yên Lạc thuộc tỉnh Vĩnh Phúc; </li>
                                <li>
                                    Các thành phố Bắc Ninh, Từ Sơn; các thị xã Thuận Thành, Quế Võ và các huyện Tiên Du, Yên Phong, Gia Bình, Lương
                                    Tài thuộc tỉnh Bắc Ninh; </li>
                                <li>
                                    Thành phố Hưng Yên, thị xã Mỹ Hào và các huyện Văn Lâm, Văn Giang, Yên Mỹ thuộc tỉnh Hưng Yên; </li>
                                <li>
                                    Thành phố Chí Linh, thị xã Kinh Môn và các huyện Cẩm Giàng, Bình Giang, Tứ Kỳ, Gia Lộc, Nam Sách, Kim Thành
                                    thuộc
                                    tỉnh Hải Dương; </li>
                                <li>
                                    Thành phố Cẩm Phả thuộc tỉnh Quảng Ninh; </li>
                                <li>
                                    Các huyện còn lại thuộc thành phố Hải Phòng; </li>
                                <li>
                                    Thành phố Thái Bình thuộc tỉnh Thái Bình; </li>
                                <li>
                                    Thành phố Nam Định và huyện Mỹ Lộc thuộc tỉnh Nam Định; </li>
                                <li>
                                    Thành phố Ninh Bình thuộc tỉnh Ninh Bình; </li>
                                <li>
                                    Các thành phố Thanh Hóa, Sầm Sơn và các thị xã Bỉm Sơn, Nghi Sơn thuộc tỉnh Thanh Hóa; </li>
                                <li>
                                    Thành phố Vinh, thị xã Cửa Lò và các huyện Nghi Lộc, Hưng Nguyên thuộc tỉnh Nghệ An; </li>
                                <li>
                                    Thành phố Đồng Hới thuộc tỉnh Quảng Bình; </li>
                                <li>
                                    Thành phố Huế thuộc tỉnh Thừa Thiên Huế; </li>
                                <li>
                                    Các thành phố Hội An, Tam Kỳ thuộc tỉnh Quảng Nam; </li>
                                <li>
                                    Các quận, huyện thuộc thành phố Đà Nẵng; </li>
                                <li>
                                    Các thành phố Nha Trang, Cam Ranh và thị xã Ninh Hòa thuộc tỉnh Khánh Hòa; </li>
                                <li>
                                    Các thành phố Đà Lạt, Bảo Lộc thuộc tỉnh Lâm Đồng; </li>
                                <li>
                                    Thành phố Phan Thiết thuộc tỉnh Bình Thuận; </li>
                                <li>
                                    Huyện Cần Giờ thuộc Thành phố Hồ Chí Minh; </li>
                                <li>
                                    Thành phố Tây Ninh, các thị xã Trảng Bàng, Hòa Thành và huyện Gò Dầu thuộc tỉnh Tây Ninh; </li>
                                <li>
                                    Các huyện Định Quán, Tân Phú, Cẩm Mỹ thuộc tỉnh Đồng Nai; </li>
                                <li>
                                    Thành phố Đồng Xoài, thị xã Chơn Thành và huyện Đồng Phú thuộc tỉnh Bình Phước; </li>
                                <li>
                                    Thành phố Bà Rịa thuộc tỉnh Bà Rịa - Vũng Tàu; </li>
                                <li>
                                    Các huyện Thủ Thừa, Cần Đước và thị xã Kiến Tường thuộc tỉnh Long An; </li>
                                <li>
                                    Thành phố Mỹ Tho và huyện Châu Thành thuộc tỉnh Tiền Giang; </li>
                                <li>
                                    Thành phố Bến Tre và huyện Châu Thành thuộc tỉnh Bến Tre; </li>
                                <li>
                                    Thành phố Vĩnh Long và thị xã Bình Minh thuộc tỉnh Vĩnh Long; </li>
                                <li>
                                    Các quận thuộc thành phố Cần Thơ; </li>
                                <li>
                                    Các thành phố Rạch Giá, Hà Tiên, Phú Quốc thuộc tỉnh Kiên Giang; </li>
                                <li>
                                    Các thành phố Long Xuyên, Châu Đốc thuộc tỉnh An Giang; </li>
                                <li>
                                    Thành phố Trà Vinh thuộc tỉnh Trà Vinh;
                                </li>
                                <li>
                                    Thành phố Sóc Trăng thuộc tỉnh Sóc Trăng;
                                </li>
                                <li>
                                    Thành phố Bạc Liêu thuộc tỉnh Bạc Liêu;
                                </li>
                                <li>
                                    Thành phố Cà Mau thuộc tỉnh Cà Mau.
                                </li>
                            </ul>
                            <p></p>
                            <p class="text-primary"><strong>3. Vùng III, gồm các địa bàn:</strong></p>
                            <ul>
                                <li>Các thành phố trực thuộc tỉnh còn lại (trừ các thành phố trực thuộc tỉnh nêu tại vùng I, vùng II); </li>
                                <li>Thị xã Sa Pa, huyện Bảo Thắng thuộc tỉnh Lào Cai; </li>
                                <li>Các huyện Phú Bình, Phú Lương, Đồng Hỷ, Đại Từ thuộc tỉnh Thái Nguyên; </li>
                                <li>Các huyện Hiệp Hòa, Tân Yên, Lạng Giang thuộc tỉnh Bắc Giang; </li>
                                <li>Các huyện Ninh Giang, Thanh Miện, Thanh Hà thuộc tỉnh Hải Dương; </li>
                                <li>Thị xã Phú Thọ và các huyện Phù Ninh, Lâm Thao, Thanh Ba, Tam Nông thuộc tỉnh Phú Thọ; </li>
                                <li>Các huyện Vĩnh Tường, Tam Đảo, Tam Dương, Lập Thạch, Sông Lô thuộc tỉnh Vĩnh Phúc; </li>
                                <li>Các huyện Vân Đồn, Hải Hà, Đầm Hà, Tiên Yên thuộc tỉnh Quảng Ninh; </li>
                                <li>Các huyện còn lại thuộc tỉnh Hưng Yên; </li>
                                <li>Các huyện Thái Thụy, Tiền Hải thuộc tỉnh Thái Bình; </li>
                                <li>Các huyện còn lại thuộc tỉnh Nam Định; </li>
                                <li>Thị xã Duy Tiên và huyện Kim Bảng thuộc tỉnh Hà Nam; </li>
                                <li>Các huyện Gia Viễn, Yên Khánh, Hoa Lư thuộc tỉnh Ninh Bình; </li>
                                <li>Các huyện Đông Sơn, Quảng Xương, Triệu Sơn, Thọ Xuân, Yên Định, Vĩnh Lộc, Thiệu Hóa, Hà Trung, Hậu Lộc, Nga Sơn,
                                    Hoằng Hóa, Nông Cống thuộc tỉnh Thanh Hóa; </li>
                                <li>Các huyện Quỳnh Lưu, Yên Thành, Diễn Châu, Đô Lương, Nam Đàn, Nghĩa Đàn và các thị xã Thái Hòa, Hoàng Mai thuộc
                                    tỉnh
                                    Nghệ An; </li>
                                <li>Thị xã Kỳ Anh thuộc tỉnh Hà Tĩnh; </li>
                                <li>Các thị xã Hương Thủy, Hương Trà và các huyện Phú Lộc, Phong Điền, Quảng Điền, Phú Vang thuộc tỉnh Thừa Thiên
                                    Huế;
                                </li>
                                <li>Thị xã Điện Bàn và các huyện Đại Lộc, Duy Xuyên, Núi Thành, Quế Sơn, Thăng Bình, Phú Ninh thuộc tỉnh Quảng Nam;
                                </li>
                                <li>Các huyện Bình Sơn, Sơn Tịnh thuộc tỉnh Quảng Ngãi; </li>
                                <li>Các thị xã Sông Cầu, Đông Hòa thuộc tỉnh Phú Yên; </li>
                                <li>Các huyện Ninh Hải, Thuận Bắc, Ninh Phước thuộc tỉnh Ninh Thuận; </li>
                                <li>Các huyện Cam Lâm, Diên Khánh, Vạn Ninh thuộc tỉnh Khánh Hòa; </li>
                                <li>Huyện Đăk Hà thuộc tỉnh Kon Tum; </li>
                                <li>Các huyện Đức Trọng, Di Linh thuộc tỉnh Lâm Đồng; </li>
                                <li>Thị xã La Gi và các huyện Hàm Thuận Bắc, Hàm Thuận Nam thuộc tỉnh Bình Thuận; </li>
                                <li>Các thị xã Phước Long, Bình Long và các huyện Hớn Quản, Lộc Ninh, Phú Riềng thuộc tỉnh Bình Phước; </li>
                                <li>Các huyện còn lại thuộc tỉnh Tây Ninh; </li>
                                <li>Các huyện Long Điền, Đất Đỏ, Xuyên Mộc, Châu Đức, Côn Đảo thuộc tỉnh Bà Rịa - Vũng Tàu; </li>
                                <li>Các huyện Đức Huệ, Châu Thành, Tân Trụ, Thạnh Hóa thuộc tỉnh Long An; </li>
                                <li>Thị xã Cai Lậy và các huyện Chợ Gạo, Tân Phước thuộc tỉnh Tiền Giang; </li>
                                <li>Các huyện Ba Tri, Bình Đại, Mỏ Cày Nam thuộc tỉnh Bến Tre; </li>
                                <li>Các huyện Mang Thít, Long Hồ thuộc tỉnh Vĩnh Long; </li>
                                <li>Các huyện thuộc thành phố Cần Thơ; </li>
                                <li>Các huyện Kiên Lương, Kiên Hải, Châu Thành thuộc tỉnh Kiên Giang; </li>
                                <li>Thị xã Tân Châu và các huyện Châu Phú, Châu Thành, Thoại Sơn thuộc tỉnh An Giang; </li>
                                <li>Các huyện Châu Thành, Châu Thành A thuộc tỉnh Hậu Giang; </li>
                                <li>Thị xã Duyên Hải thuộc tỉnh Trà Vinh; </li>
                                <li>Thị xã Giá Rai và huyện Hòa Bình thuộc tỉnh Bạc Liêu; </li>
                                <li>Các thị xã Vĩnh Châu, Ngã Năm thuộc tỉnh Sóc Trăng; </li>
                                <li>Các huyện Năm Căn, Cái Nước, U Minh, Trần Văn Thời thuộc tỉnh Cà Mau; </li>
                                <li>Các huyện Lệ Thủy, Quảng Ninh, Bố Trạch, Quảng Trạch và thị xã Ba Đồn thuộc tỉnh Quảng Bình.</li>
                            </ul>
                            <p class="text-primary"><strong>4. Vùng IV, gồm các địa bàn còn lại</strong></p>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Đóng lại</button></div>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- jQuery và Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<script>
   $(document).ready(function() {
    // Khi người dùng nhấn vào tiêu đề hoặc nút, nội dung sẽ được mở/đóng
    $('.toggle-panel').on('click', function() {
        // Lấy phần collapse tương ứng
        var panel = $(this).closest('.panel__item').find('.collapse');
        
        // Kiểm tra nếu panel đang mở thì đóng lại, nếu đang đóng thì mở ra
        if (panel.hasClass('in')) {
            panel.collapse('hide');
        } else {
            panel.collapse('show');
        }
    });

    // Thay đổi icon khi mở/đóng panel
    $('.collapse').on('show.bs.collapse', function () {
        $(this).closest('.panel__item').find('.fa-plus').hide();
        $(this).closest('.panel__item').find('.fa-minus').show();
    }).on('hide.bs.collapse', function () {
        $(this).closest('.panel__item').find('.fa-plus').show();
        $(this).closest('.panel__item').find('.fa-minus').hide();
    });
});

</script>

    <script>
        var sentJobIds = new Set();
        let impressionData = [];
        let currentUniqueSearchId = '';

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        var onFeatureTrackingTa = '1';

        let jobRenderedIds = [];
        let jobPositionMapping = {};
        if (onFeatureTrackingTa) {
            $('.job-ta').each(function(index, el) {
                let jobId = $(el).data('job-id');
                if (jobId) {
                    jobRenderedIds.push(jobId);
                    jobPositionMapping[jobId] = parseInt(index) + 1;
                }
            });
            if (jobRenderedIds.length) {
                ta('jobRendered', {
                    ts: new Date().getTime()
                    , p: 'GrossNet'
                    , jb_ids: jobRenderedIds
                    , oth: {
                        u_sr_id: currentUniqueSearchId
                    , }
                })
            }
        }

        function differenceOf2Arrays(array1, array2) {
            if (array1.length == 0) {
                return array2;
            }
            if (array2.length == 0) {
                return array1;
            }
            var temp = [];
            array1 = array1.toString().split(',').map(Number);
            array2 = array2.toString().split(',').map(Number);

            for (var i in array1) {
                if (array2.indexOf(array1[i]) === -1) temp.push(array1[i]);
            }
            for (i in array2) {
                if (array1.indexOf(array2[i]) === -1) temp.push(array2[i]);
            }
            return temp.sort((a, b) => a - b);
        }

        let jobsInViewPort = [];
        const taTop = $('.ta-top');
        $.fn.isInViewport = function(checkTitle = true) {
            const taTopHeight = taTop.height() || 0;
            let elementHeight = $(this).height();
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var scrollTop = $(window).scrollTop();
            var viewportTop = scrollTop + taTopHeight;
            var viewportBottom = scrollTop + $(window).height();

            return ($(this).is(':visible') && elementBottom > viewportTop + elementHeight && elementTop < viewportBottom - elementHeight) || (checkTitle && Array.from($(this).find('a:visible')).some((e) => $(e).isInViewport(false)));
        };

        function taChecker(index, el) {
            if ($(el).isInViewport()) {
                let jobId = $(el).data('job-id');
                let jrId = $(el).data('jr-id');
                let box = $(el).data('box');
                let fitness = $(el).data('job-fitness');
                if (!sentJobIds.has(jobId) && jobId) {
                    sentJobIds.add(jobId);
                    const time = new Date().getTime();
                    setTimeout(() => {
                        if ($(el).isInViewport()) {
                            impressionData.push({
                                jb_id: jobId
                                , impr_pos: jobPositionMapping[jobId]
                                , ts: time
                                , p: 'GrossNet'
                                , b: box || ''
                                , jr_i: jrId
                                , type: "JobInViewPort"
                                , fitness: fitness
                            , });
                            currentUniqueSearchId = $(el).attr('data-u-sr-id');
                        } else {
                            sentJobIds.delete(jobId);
                        }
                    }, 800);
                }
                // console.log($(el).data('job-id'));
            } else {
                // do something else
            }
        }

        updateJobInViewPort = () => {
            $('.job-ta').each(taChecker);
            $('.ta-slick .slick-slide[aria-hidden=false] .job-ta-slick').each(taChecker);
            $('.owl-carousel .active .job-ta-owl').each(taChecker)
            setTimeout(function() {
                const oth = currentUniqueSearchId ? {
                    u_sr_id: currentUniqueSearchId
                } : null;
                if (impressionData ? .length) {
                    const impressionDataJobIds = impressionData.map(e => e.jb_id);
                    const pinnedJobIds = [];
                    const intersectionIds = pinnedJobIds.filter(element => impressionDataJobIds.includes(element));
                    let othPinnedJobIds = null;
                    if (intersectionIds.length > 0) {
                        othPinnedJobIds = {
                            pinned_job_ids: intersectionIds.join(',')
                        };
                    }

                    ta('Impressions', {
                        oth: (oth !== null || othPinnedJobIds !== null) ? {
                            ...oth
                            , ...othPinnedJobIds
                        } : null
                        , imprs: impressionData
                    });
                    impressionData = [];
                }
            }, 1000)
        };
        if (onFeatureTrackingTa) {
            $(window).on('resize scroll', function() {
                updateJobInViewPort();
            });
            // Support slick carousel tracking ta jobs.
            $('.ta-slick').on('init afterChange', function() {
                $(this).find('.slick-slide[aria-hidden=false] .job-ta-slick').each(taChecker)
            })

            $('.owl-carousel').on('initialized.owl.carousel dragged.owl.carousel translated.owl.carousel', function() {
                $(this).find('.active .job-ta-owl').each(taChecker)
            })

            updateJobInViewPort();
        }

    </script>
</div>
@endsection
