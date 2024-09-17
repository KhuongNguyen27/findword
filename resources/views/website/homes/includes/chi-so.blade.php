 <style>
     .box-work-market {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .box-work-market__item {
        align-items: center;
        display: inline-flex;
        gap: 8px;
        padding: 4px 8px;
    }

    .box-work-market__item .item-label {
        color: #263a4d;
        font-size: 16px;
        font-weight: 400;
        letter-spacing: .12px;
        line-height: 16px;
    }

    .box-work-market__item .item-number.number-job-new-today {
        color: #28c1bc;
    }

    .box-work-market__item:not(:first-child):before {
        color: #7f878f;
        content: "•";
        margin-right: 8px;
    }

 </style>
 @php
$currentDateTime = \Carbon\Carbon::now()->subMinutes(5)->format('H:i d/m/Y');
@endphp
 <div class="box-work-market">
     <div class="box-work-market__item">
         <span class="item-label">Vị trí chờ bạn khám phá
         </span>
         <span id="position-count" class="quantity item-number number-job-new-today" name="quantity_job_recruitment">{{ number_format($vi_tri_cho_ban_kham_pha, 0, ',', '.') }}</span>

     </div>
     <div class="box-work-market__item">
         <span class="item-label">Việc làm mới nhất</span>
         <span id="new-job-count" class="quantity item-number number-job-new-today" name="quantity_job_new_today">{{ number_format($quantity_job_new, 0, ',', '.') }}</span>
     </div>
     <div class="box-work-market__item">
         <span class="item-label">Cập nhật lúc:</span>
         <span id="time-scan" class="time-scan item-number number-job-new-today">{{ $currentDateTime }}</span>
     </div>
 </div>
