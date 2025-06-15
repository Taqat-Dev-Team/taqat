<header id="header" class="header type-3">

    <div class="header-top">

        <div class="row">

            <div class="large-12 columns">
                <ul class="social-icons">
                    <li class="twitter">
                        <a target="_blank" href="https://twitter.com/PCBSPalestine">Twitter</a>
                    </li>
                    <li class="facebook">
                        <a target="_blank" href="https://www.facebook.com/PCBSPalestine/">Facebook</a>
                    </li>
                    <li class="linkedin">
                        <a target="_blank"
                           href="https://www.linkedin.com/in/pcbs-palestinian-05b630135">Linkedin</a>
                    </li>
                    <li class="youtube">
                        <a target="_blank"
                           href="https://www.youtube.com/channel/UCeFbu-hKUNyhdM-G4X5VdPA">YouTube</a>
                    </li>
                    <li class="instagram">
                        <a target="_blank" href="https://www.instagram.com/pcbspalestine/">Instagram</a>
                    </li>
                </ul>

                <div class="lang-icons">
                    <i class="dribbble"></i>
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown">
{{--                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    {{ LaravelLocalization::getCurrentLocaleNative() }}--}}
{{--                                                </a>--}}
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                                            {{ $properties['native'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>


                    {{--                    <a href="https://pcbs.gov.ps/default.aspx" id="langAnc"--}}
{{--                       style="color:#b4b4b4 !important;font-weight: bold;font-family:'Tw Cen MT Condensed','Calibri' !important;font-size:1rem;float:left;">English--}}
{{--                        <img src="https://pcbs.gov.ps/images/lang-16-b4.png" style="vertical-align: text-top;"></a>--}}


                </div>
                <!--/ .social-icons-->
            </div>

        </div>
        <!--/ .row-->

    </div>
    <!--/ .header-top-->

    <div class="header-middle">

        <div class="row">

            <div class="large-12 columns">
                <div class="header-middle-entry">

                    <div class="logo">
                        <span class="sop" style="font-family: 'Droid Arabic Kufi'">دولة فلسطين</span>
                        <span class="tmm_logo">
								<a title="logo" href="https://pcbs.gov.ps/defaultAr.aspx">
								<img src="https://pcbs.gov.ps/images/logowhite129.png" alt="logo" title="pcbs">
								</a>
							</span>
                        <br>
                        <span class="sop2" style="font-family: 'Droid Arabic Kufi'">الجـهـاز الـمـركـزي لـلاحـصـاء الـفلسطيني</span>
                    </div>

                    <div class="account">

                        <ul>

                            <li class="icon-info" style="color:#fdfdfd;"><a
                                    href="https://pcbs.gov.ps/site/lang__ar/538/default.aspx"
                                    style="color:#fff !important; font-family: 'Droid Arabic Kufi'"> عن الجهاز</a>
                            </li>
                            <li class="icon-email"><a href="https://pcbs.gov.ps/site/lang__ar/600/default.aspx"
                                                      style=" font-family: 'Droid Arabic Kufi'">اتصل بنا</a></li>
                            <li style="display:none;" data-login="loginDialog">this leazy fix to js error in
                                modal.js
                            </li>
                            <li style="display:none;" data-account="accountDialog">this leazy fix to js error in
                                modal.js
                            </li>
                        </ul>

                        <!-- - - - - - - - DONATE BUTTON - - - - - - - -->

                        <a target="_blank" href="https://pcbs.gov.ps/census2017/" class="button large donate"
                           style=" display:none; font-family: 'Droid Arabic Kufi'">تعداد <br> 2017</a>

                        <!-- - - - - - - - END DONATE BUTTON - - - - - - - -->

                    </div>
                </div>

            </div>

        </div>
        <!--/ .row-->

    </div>
    <!--/ .header-middle-->

    <div class="header-bottom">

        <div class="row">

            <div class="large-12 columns">
                <!-- menu -->
                <nav id="navigation" class="navigation top-bar" data-topbar>

                    <div class="menu-primary-menu-container">

                        <ul id="menu-primary-menu" class="menu">
                            <li id="home" class=" menu-item  "><a
                                    href="https://pcbs.gov.ps/site/lang__ar/1/default.aspx">الصفحة الرئيسية</a></li>
                            <li id="about_pcbs" class=" menu-item "><a href="#">حول الجهاز</a>
                                <ul class="sub-menu">
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/538/default.aspx?lang=ar">المهمة
                                            الرئيسية </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/539/default.aspx?lang=ar">الأساس
                                            القانوني </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/540/default.aspx?lang=ar">المبادئ
                                            الأساسية </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/543/default.aspx?lang=ar">الممارسات
                                            الجيدة </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/542/default.aspx?lang=ar">المجلس
                                            الاستشاري</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/575/default.aspx?lang=ar">ميثاق
                                            الممارسات للاحصاءات الرسمية الفلسطينية</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/595/default.aspx?lang=ar">مكتبة
                                            الجهاز</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/598/default.aspx?lang=ar">مركز
                                            البحث</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/599/default.aspx?lang=ar">من يعمل
                                            بالجهاز</a></li>
                                    <li>
                                        <a href="https://pcbs.gov.ps/document/pdf/organizational_structure.pdf?lang=ar">الهيكل
                                            التنظيمي</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/962/default.aspx?lang=ar">اللجنة
                                            الاستشارية للاحصاءات الاقتصادية</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/997/default.aspx?lang=ar">الاستراتيجيات
                                            الوطنية لتطوير الاحصاءات </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/1387/default.aspx?lang=ar">مراجعة
                                            النظراء</a></li>
                                    <li>
                                        <a href="https://pcbs.gov.ps/site/lang__ar/1044/default.aspx?lang=ar">سياسات</a>
                                    </li>
                                    <li><a href="https://www.pcbs.gov.ps/papersar.aspx?lang=ar">اوراق علمية</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/600/default.aspx?lang=ar">اتصل
                                            بنا</a></li>
                                </ul>
                            </li>
                            <li id="statistics" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/site/lang__ar/507/default.aspx">احصاءات</a></li>
                            <li id="مطبوعات" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/pcbs_2012/Publications_AR.aspx">مطبوعات</a></li>
                            <li id="بيانات_صحفية" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/pcbs_2012/PressAr.aspx">بيانات صحفية</a></li>
                            <li id="resources" class=" menu-item "><a href="#">مـوارد</a>
                                <ul class="sub-menu">
                                    <li><a href="#">المعايير الدولية
                                            <ul class="sub-menu">
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/606/default.aspx">النظام
                                                        العام لنشر البيانات</a></li>
                                            </ul>
                                        </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/1014/default.aspx?lang=ar">التصنيفات
                                            المعيارية</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/611/default.aspx?lang=ar">مؤشرات
                                            احصائية</a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/612/default.aspx?lang=ar">معجم
                                            المصطلحات والمفاهيم الاحصائية </a></li>
                                    <li><a href="https://pcbs.gov.ps/site/lang__ar/1143/default.aspx?lang=ar">دليل
                                            تنفيذ مشروع احصائي(GSBPM)</a></li>
                                </ul>
                            </li>
                            <li id="الأرقام_القياسية" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/site/lang__ar/1095/default.aspx">الأرقام القياسية</a>
                            </li>
                            <li id="media_room" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/site/lang__ar/616/default.aspx">غرفة الصحافة</a></li>
                            <li id="عطاءات" class=" menu-item "><a
                                    href="https://pcbs.gov.ps/tendersAr.aspx">عطاءات</a></li>
                            <li id="links" class=" menu-item "><a href="#">روابط</a>
                                <ul class="sub-menu">
                                    <li><a href="#">داخل فلسطين
                                            <ul class="sub-menu">
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/628/default.aspx">مؤسسات
                                                        حكومية</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/629/default.aspx">مؤسسات
                                                        غير حكومية</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/630/default.aspx">الجامعات
                                                        والكليات</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/631/default.aspx">مؤسسة
                                                        البحث العلمي</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/632/default.aspx">مواقع
                                                        اخرى</a></li>
                                            </ul>
                                        </a></li>
                                    <li><a href="#">خارج فلسطين
                                            <ul class="sub-menu">
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/634/default.aspx">مؤسسات
                                                        دولية</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/635/default.aspx">مؤسسات
                                                        البحث العلمي العربية</a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/647/default.aspx">مؤسسات
                                                        احصائية </a></li>
                                                <li><a href="https://pcbs.gov.ps/site/lang__ar/636/default.aspx">مؤسسات
                                                        احصائية دولية</a></li>
                                            </ul>
                                        </a></li>
                                </ul>
                            </li>

                            <li id="news" class="is-mega-menu">
                                <a href="https://pcbs.gov.ps/postar.aspx?showAll=showAll"
                                   style="font-family: 'Droid Arabic Kufi'">الاخبار</a>

                                <div class="mega-menu">
                                    <ul class="sub-menu">
                                        <li>
                                            <span data-column="one_fourth"></span>
                                            <ul class="sub-menu one_fourth" style="width: 285px;">
                                                <li>
                                                    <a href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4696&amp;mid=3915&amp;wversion=Staging">جدول
                                                        غلاء المعيشة الفلسطيني لشهر كانون ثاني، 01/2024 </a></li>
                                                <li>
                                                    <a href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4693&amp;mid=3915&amp;wversion=Staging">الرقم
                                                        القياسي لكميات الإنتاج الصناعي، للعام 2023 ولشهر كانون أول،
                                                        12/2023. </a></li>
                                                <li>
                                                    <a href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4691&amp;mid=3915&amp;wversion=Staging">الرقم
                                                        القياسي لأسعار المنتج في فلسطين للعام 2023 ولشهر كانون أول،
                                                        12/2023 </a></li>
                                                <li>
                                                    <a href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4689&amp;mid=3915&amp;wversion=Staging">مؤشر
                                                        أسعار تكاليف البناء والطرق وشبكات المياه وشبكات المجاري في
                                                        الضفة الغربية للعام 2023 ولشهر كانون أول،12/2023 </a></li>
                                                <li style="color:#14b3e4 !important"><a
                                                        href="https://pcbs.gov.ps/postar.aspx?showAll=showAll"> عرض
                                                        جميع الاخبار </a></li>


                                            </ul>
                                        </li>
                                        <li>
                                            <span data-column="three_fourth"></span>
                                            <ul class="sub-menu three_fourth" style="width: 855px;">
                                                <li class="clearfix menu-item">
                                                    <div class="row post-list three-cols">
                                                        <article class="medium-4 large-4 columns articleAd">
                                                            <div
                                                                class="post border post-alternate-4 elementFadeRun">
                                                                <a href="#" class="image-post item-overlay"><img
                                                                        src="https://pcbs.gov.ps/DesktopModules/Articles/images/PPI.jpg"
                                                                        alt=""></a>
                                                                <div class="entry-header"><h4 class="entry-title"><a
                                                                            href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4701&amp;mid=3915&amp;wversion=Staging">الرقم
                                                                            القياسي لأسعار المنتج في فلسطين لشهر
                                                                            كانون ثاني، 01/2024 </a></h4></div>
                                                            </div>
                                                        </article>
                                                        <article class="medium-4 large-4 columns articleAd">
                                                            <div
                                                                class="post border post-alternate-4 elementFadeRun">
                                                                <a href="#" class="image-post item-overlay"><img
                                                                        src="https://pcbs.gov.ps/DesktopModules/Articles/images/press_releases/CRWSN.jpg"
                                                                        alt=""></a>
                                                                <div class="entry-header"><h4 class="entry-title"><a
                                                                            href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4699&amp;mid=3915&amp;wversion=Staging">مؤشر
                                                                            أسعار تكاليف البناء والطرق وشبكات المياه
                                                                            وشبكات المجاري في الضفة الغربية لشهر
                                                                            كانون ثاني،01/2024 </a></h4></div>
                                                            </div>
                                                        </article>
                                                        <article class="medium-4 large-4 columns articleAd">
                                                            <div
                                                                class="post border post-alternate-4 elementFadeRun">
                                                                <a href="#" class="image-post item-overlay"><img
                                                                        src="https://pcbs.gov.ps/DesktopModules/Articles/images/press_releases/ExternalTrade.jpg"
                                                                        alt=""></a>
                                                                <div class="entry-header"><h4 class="entry-title"><a
                                                                            href="https://pcbs.gov.ps/site/512/default.aspx?tabID=512&amp;lang=ar&amp;ItemID=4698&amp;mid=3915&amp;wversion=Staging">النتائج
                                                                            الأولية للتجارة الخارجية المرصودة للسلع
                                                                            لشهر كانون اول، 12/2023</a></h4></div>
                                                            </div>
                                                        </article>

                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <div class="search-form-nav">
                        <form method="get" action="https://pcbs.gov.ps/pcbs_searchAr.aspx">
                            <fieldset>
                                <input placeholder="بـحث" type="text" name="q" autocomplete="off" value=""
                                       class="advanced_search">
                                <button type="submit" class="submit-search">بحث</button>
                            </fieldset>
                        </form>
                    </div>

                </nav>
                <!--/ .navigation-->

                <!-- END menu -->

            </div>

        </div>
        <!--/ .row-->

    </div>
    <!--/ .header-bottom-->

</header>
