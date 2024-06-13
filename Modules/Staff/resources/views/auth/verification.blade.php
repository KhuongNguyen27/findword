@extends('website.layouts.auth')
@section('content')
<!-- <div class="fb_content clearfix " id="content" role="main">
    <div class="UIFullPage_Container">
        <div class="_8it_">
            <div class="mtl ptm uiInterstitial _1v_x uiInterstitialLarge uiBoxWhite">
                <div class="uiHeader uiHeaderBottomBorder mhl mts uiHeaderPage interstitialHeader">
                    <div class="clearfix uiHeaderTop">
                        <div class="rfloat _ohf">
                            <h2 class="accessible_elem">Nhập mã từ email của bạn</h2>
                            <div class="uiHeaderActions"></div>
                        </div>
                        <div>
                            <h2 class="uiHeaderTitle" aria-hidden="true">Nhập mã từ email của bạn</h2>
                        </div>
                    </div>
                </div>
                <div class="phl ptm uiInterstitialContent">
                    <div class="mts mbl _1v_-">Hãy cho chúng tôi biết email này thuộc về bạn. Hãy nhập mã trong email
                        được gửi đến <span class="fwb">foafyfgaqm3k@fakemailserver.com</span>.</div>
                    <form rel="async"
                        action="/confirm_code/dialog/submit/?next=https%3A%2F%2Fwww.facebook.com%2F&amp;cp=foafyfgaqm3k%40fakemailserver.com&amp;from_cliff=1&amp;conf_surface=hard_cliff&amp;event_location=cliff"
                        method="post" onsubmit="" id="u_0_1_1t"><input type="hidden" name="jazoest" value="25323"
                            autocomplete="off"><input type="hidden" name="fb_dtsg"
                            value="NAcMrQACw7ptqBp6keeqGXEg-t3h3DNAGJC_5mZhpwn4-XHpN47X4WA:29:1717819318"
                            autocomplete="off">
                        <div class="_192s" id="conf_dialog_middle_components">
                            <div><label class="_89rd _8iu4"><span class="_2qyq"> FB- </span>
                                    <div class="_8n2n _8na1" id="u_0_2_yA"><input type="text"
                                            class="inputtext _8n1_ _9c54" id="code_in_cliff" autofocus="1" name="code"
                                            size="5" maxlength="5" fdprocessedid="in0r18"></div>
                                </label></div>
                            <div class="hidden_elem _3ah9" id="conf_code_length_error">Vui lòng kiểm tra email mà chúng
                                tôi đã gửi và nhập mã gồm 5 chữ số.</div>
                            <div class="_8iu0"><a class="_1w00 _8iu7"
                                    href="/confirm/resend_code/?cp=foafyfgaqm3k%40fakemailserver.com" rel="dialog-post"
                                    role="button" waprocessedanchor="true">Gửi lại email</a></div>
                        </div><input type="hidden" autocomplete="off" name="source_verified" value="www_reg">
                        <div class="_8iu2 clearfix">
                            <div class="rfloat"><a role="button" class="_42ft _4jy0 _8iu3 _4jy4 _517h _51sy"
                                    href="/change_contactpoint/dialog/" rel="dialog">Cập nhật thông tin liên
                                    hệ</a><button value="1"
                                    class="_42ft _42fr mls _4jy0 _8iu3 _8iu6 _42fr _4jy4 _4jy1 selected _51sy"
                                    name="confirm" disabled="1" type="submit" id="u_0_3_GH">Tiếp tục</button></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="_4wkp">
                <div class="_9az">
                    <div class="_4wkq">Bạn vẫn gặp sự cố?</div><span>&nbsp;</span>Bạn cũng có thể nhập mã được gửi đến:
                </div>
                <div>
                    <div id="remove_84565434342" class="_9d2">
                        <div id="cp_84565434342" class="_4wkr"><span dir="ltr">056 543 4342</span></div>
                        <form rel="async" class="inlineBlock"
                            action="/removecontact/?privacy_mutation_token=eyJ0eXBlIjowLCJjcmVhdGlvbl90aW1lIjoxNzE3ODE5NDc5LCJjYWxsc2l0ZV9pZCI6MzAyMDE1NjU0NDc0MjgzfQ%3D%3D"
                            method="post" onsubmit="" id="u_0_4_El"><input type="hidden" name="jazoest" value="25323"
                                autocomplete="off"><input type="hidden" name="fb_dtsg"
                                value="NAcMrQACw7ptqBp6keeqGXEg-t3h3DNAGJC_5mZhpwn4-XHpN47X4WA:29:1717819318"
                                autocomplete="off"><input type="hidden" autocomplete="off" name="contact"
                                value="+84565434342"><input type="hidden" autocomplete="off" name="surface"
                                value="cliff"><button id="link_84565434342" class="_9d1" title="Gỡ" aria-label="Gỡ"
                                type="submit" fdprocessedid="j6e8qi">Gỡ</button></form>
                    </div>
                </div>
                <div>
                    <div class="_4wks">Đã gỡ</div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Nhập mã từ email của bạn</h3>
        <!--Login Form-->
        <form action="{{ route('auth.postForgot')}}" method="POST">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @csrf
            <div class="form-group">
                <label>Hãy cho chúng tôi biết email này thuộc về bạn. Hãy nhập mã trong email
                được gửi đến <span class="fwb">foafyfgaqm3k@fakemailserver.com</span></label>
                <input type="email" name="email" placeholder="">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" onclick="showLoading()">Kiểm tra <i
                        class="ti-arrow-right"></i></button>
                <div id="loadingSpinner" class="loading-spinner"></div>
            </div>
        </form>
    </div>
</div>


@endsection