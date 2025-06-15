<!DOCTYPE html>
<html lang="en" direction="rtl" style="direction: rtl;">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>طلب التحاق</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Page with empty content"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="canonical" href=""/>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            margin-top: 20px;
        }
        .form-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: contain;
        }
        h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="file"] {
            padding: 5px 15px;
        }
        button {
            padding: 12px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
        *, html, body {
            text-align: right;
            margin: 0;
        }

        .loading-spinner {
    display: none;
    width: 30px;
    height: 30px;
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-left-color: #000;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  .submit-container {
    position: relative;
    display: inline-block;
  }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="form-container">
                <form class="needs-validation register-form" id="my-form" name="my-form" method="POST" enctype="multipart/form-data" style="margin:auto">
                    @csrf
                    <div class="form-header">
                        <img src="{{asset('assets/logo.png')}}" width="180px" alt="Company Logo" class="logo">
                    </div>

                    <div class="col-lg-12  col-sm-12">
                        <div class="form-group">
                            <label for="email">
                                الايميل
                                <span style="color: red">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="error email"></div>
                        </div>
                    </div>
                    <div class="submit-check-container">
                    <div class="col-lg-12  col-sm-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-warning check_users">ملىء النموذج</button>
                            <div class="loading-spinner"></div>

                        </div>
                    </div>
                </div>
                    <div class="col-lg-12  col-sm-12">
                        <div class="form-group">
                            <label for="name">الاسم
                                <span style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="error name"></div>
                        </div>
                    </div>

                    <div class="col-lg-12  col-sm-12">
                        <div class="form-group">
                            <label for="mobile">رقم الجوال
                                <span style="color: red">*</span>
                            </label>
                            <input type="tel" class="form-control" id="mobile" name="mobile">
                            <div class="error mobile"></div>
                        </div>
                    </div>

                    <div class="col-lg-12  col-sm-12">
                        <div class="form-group">
                            <label for="whatsapp">الواتساب
                                <span style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                            <div class="error whatsapp"></div>
                        </div>
                    </div>

                    <div class="col-lg-12  col-sm-12">
                        <label for="marital_status">الحالة الاجتماعية
                            <span style="color: red">*</span>
                        </label>
                        <select class="form-control" id="marital_status" name="marital_status">
                            <option value="">اختر</option>
                            <option value="أعزب">أعزب</option>
                            <option value="متزوج">متزوج</option>
                        </select>
                    </div>

                    <div class="col-lg-12  col-sm-12">
                        <label for="job">المسمى الوظيفي
                            <span style="color: red">*</span>
                        </label>
                        <select class="form-control" id="job" name="job">
                            <option value="">اختر</option>
                            <option value="مبرمج ويب">مبرمج ويب</option>
                            <option value="مبرمج موبايل">مبرمج موبايل</option>
                            <option value="مصمم جرافيك">مصمم جرافيك</option>
                            <option value="تسويق">تسويق</option>
                            <option value="اخرى">اخرى</option>
                        </select>
                    </div>

                    <div class="col-lg-12 col-sm-12 mt-1">
                        <div class="form-group">
                            <label for="company_name">اسم الشركة
                                <span style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="company_name" name="company_name">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="salary">الراتب اكبر من
                                <span style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="sallary" name="sallary">
                        </div>
                    </div>


                    <div class="col-lg-12  col-sm-12">
                        <label for="original_place">مكان السكن الاصلي
                            <span style="color: red">*</span>
                        </label>
                        <select class="form-control" id="original_place" name="original_place">
                            <option value="">اختر</option>
                            <option value="شمال غزة">شمال غزة</option>
                            <option value="مدينة غزة">مدينة غزة</option>
                            <option value="الوسطى">الوسطى</option>
                            <option value="خانيونس">خانيونس</option>
                            <option value="رفح">رفح</option>
                        </select>
                    </div>


                    <div class="col-lg-12  col-sm-12">
                        <label for="displacement_places">مكان النزوح
                            <span style="color: red">*</span>
                        </label>
                        <select class="form-control" id="displacement_place" name="displacement_place">
                            <option value="">اختر</option>
                            <option value="خانيونس">خانيونس</option>
                            <option value="دير البلح">دير البلح</option>
                            <option value="الزوايدة">الزوايدة</option>
                            <option value="النصيرات">النصيرات</option>
                            <option value="اخرى">اخرى</option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="photo">الصورة الشخصية
                                <span style="color: red">*</span>
                            </label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                    </div>
                    <div class="submit-container">

                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <div class="loading-spinner"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('front.include.scripts')
</body>
</html>
