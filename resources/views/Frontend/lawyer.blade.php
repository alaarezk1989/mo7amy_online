@extends(FEI.'.master')
@section('content')

  <!--*******************************************************************-->
  <section class="profile">
     <div class="container-fluid">
        <div class="row">
           <div class="cover-container">
              <img src="{{ asset('public/assets/'.FE .'/img/Lawyer%20Profile%20Page%20Image%201.png')}}" alt="cover" class="parent-img">
           </div>
           <div class="top-container">
             @if($user_data->image !='')
               <img src="{{ asset('public/uploads/user_img')}}/{{$user_data->image}}" alt="{{$user_data->name}}" class="child-img" />
             @else
               <img src="{{ asset('public/uploads')}}/avater.png" alt="profile" class="child-img"/>
             @endif

              <div class="profile-container">
                 <form id="form-profile">
                    <label tabindex="0" for="my-file" class="input-file-trigger label2">
                      <i class="fa fa-camera" aria-hidden="true"></i></label>
                    <input class="input-file" id="my-file" type="file">
                 </form>
              </div>
           </div>
        </div>
     </div>
     <div class="container">
        <div class="row">
           <div class="col-md-4">
              <div class="lawyer-info">
                 <h4>معلومات عن المحامى </h4>
                 <ul class="list-unstyled ul-lawyer">
                    <li> <i class="fa fa-map-marker" aria-hidden="true"></i> {{$user_country->name}} , {{$user_city->name}}  </li>
                    <li> <i class="fa fa-birthday-cake" aria-hidden="true"></i>  {{$birthdate_year}} {{trans('cpanel.year')}} </li>
                    <li> <i class="fa fa-phone" aria-hidden="true"></i> </li>
                    <li> <i class="fa fa-envelope" aria-hidden="true"></i></li>
                 </ul>
                 <span class="text-center"> 150 </span>
                 <p class="text-center"> عدد  القضايا المرفوعة </p>
                 <a href="tel:5555555555" class="text-center"> اتصل بالمحامى </a>
              </div>
           </div>
           <div class="col-md-8">
              <div class="info1">
                 <h2>{{$user_data->name}}  </h2>
                 <p> {{$user_data->career}} </p>
                 <span>
                    {{trans('cpanel.type_of_specialization')}} :
                    @php
                    $i=1;
                      foreach ($user_specialty as $row_specialty){
                      echo trans('cpanel.'.$row_specialty->specialty);
                      if($i < count($user_specialty)){
                        echo ' - ';
                      }
                      $i++;
                    }
                    @endphp
                    </span>
                 <ul class="list-unstyled prof-social">
                    <li> <a herf="">  <i class="fa fa-facebook"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-twitter"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-linkedin"></i>  </a>  </li>
                    <li> <a herf="">  <i class="fa fa-google-plus"></i> </a>  </li>
                 </ul>
                 <div class="about-lawyer">

                    <h4>{{trans('cpanel.about_lawyer')}} </h4>
                    <p>
                      {{$user_data->short_description}}
                    </p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <!--*************************************************************************-->
  <div class="container-fluid head-off">
     <div class="row">
        <img src="img/Client%20Cases%20Page%20Image.png" class="img-responsive">
     </div>
  </div>
  <section class="offers">
     <div class="container">
        <div class="row">
           <div class="arrange">
              <i class="fa fa-sort " aria-hidden="true"></i>
              <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 ترتيب
                 <span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">اعلى سعر </a></li>
                    <li><a href="#">اقل سعر  </a></li>
                    <li><a href="#"> احدث عرض  </a></li>
                 </ul>
              </div>
              <p>
                 يظهر
                 <spa> 0- 8 </spa>
                 من <span> 25 </span>  نتيجة
              </p>
              <div id='page_navigation'></div>
           </div>
           <!--***********************************************-->
           <input type='hidden' id='current_page' />
           <input type='hidden' id='show_per_page' />
           <div id='content'>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <!--********************************************************-->
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status-doing"> الحالة : <span>  تحت التنفيذ</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status-doing"> الحالة : <span>  تحت التنفيذ</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status-doing"> الحالة : <span>  تحت التنفيذ</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status-doing"> الحالة : <span>  تحت التنفيذ</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status-doing"> الحالة : <span>  تحت التنفيذ</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <!--********************************************************************-->
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client border-bott">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
              <div class="case-client">
                 <p> هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر   </p>
                 <div>
                    <div class="casetype"> نوع القضية : <span>جنائية</span></div>
                    <div class="status"> الحالة : <span>متاح</span></div>
                 </div>
                 <div class="another-details">
                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> مصر ,  القاهرة </div>
                    <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> منذ <span>55</span> دقيقة</div>
                    <div class="time"><i class="fa fa-calendar" aria-hidden="true"></i>باقى <span>55</span> يوم</div>
                    <div class="price"><i class="fa fa-money" aria-hidden="true"></i> أعلى سعر :150,000 $</div>
                    <a href="#"> عرض المزيد </a>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <div id='page_navigation'></div>
  <!--*******************************************-->
  <!--******************************Modal******************************-->
  <div class="modal fade" id="editvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel"> <i class="fa fa-pencil" aria-hidden="true"></i>تعديل الفيديو</h4>
           </div>
           <div class="modal-body">
              <form>
                 <div class="form-group">
                    <input type="text" class="form-control" id="recipient-name" placeholder="تعديل العنوان">
                 </div>
                 <div class="form-group">
                    <textarea class="form-control" id="message-text" placeholder="تعديل الوصف "></textarea>
                 </div>
              </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
              <button type="button" class="btn btn-primary saving">حفظ</button>
           </div>
        </div>
     </div>
  </div>
  <!--************************modal for delete ***************************-->
  <div class="modal fade" id="deletetvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> مسح الفيديو </h4>
           </div>
           <div class="modal-body">
              <p>هل تريد مسح هذا ؟ </p>
              <p> هل انت متأكد ؟</p>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">الغاء </button>
              <button type="button" class="btn btn-primary ms7">مسح</button>
           </div>
        </div>
     </div>
  </div>
  <!--*************************************************-->

@stop
