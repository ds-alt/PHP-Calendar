<!DOCTYPE html>
<html lang="en">

<head>
  <title>Calendar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
  <link rel="icon" type="image/png" href="icons/favicon.png">

  <!-- WEB APP MANIFEST -->
  <!-- https://web.dev/add-manifest/ -->
  <link rel="manifest" href="manifest.json">

  <!-- SERVICE WORKER -->
  <script>
    if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("worker.js");
    }
  </script>

  <!-- JS + CSS -->
  <script src="calendar.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body class="font-sans bg-gray-100">

  <?php
  // (A) DAYS MONTHS YEAR
  $months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
  ];
  $monthNow = date("m");
  $yearNow = date("Y");
  ?>

  <!-- (B) PERIOD SELECTOR -->
  <div id="calHead" class="flex items-center justify-between bg-white p-4">
    <div id="calPeriod" class="flex items-center space-x-4">
      <button id="calToday" class="fa fa-home"></button>
      <button id="calBack" class="previous">&laquo;</button>
      <select id="calMonth" class="border p-2 m-1">
        <?php foreach ($months as $m => $mth): ?>
          <option value="<?= $m ?>" <?= $m == $monthNow ? 'selected' : '' ?>><?= $mth ?></option>
        <?php endforeach; ?>
      </select>
      <input id="calYear" type="year" value="<?= $yearNow ?>" class="border p-2 m-1">
      <button id="calNext" class="next">&raquo;</button>
    </div>
    <button id="calAdd" class="fa fa-bars"></button>
  </div>

  <!-- (C) CALENDAR WRAPPER -->
  <div id="calWrap" class="flex flex-col items-center p-4 bg-white mt-4">
    <div id="calDays" class="grid grid-cols-7 w-full text-center mb-2"></div>
    <div id="calBody" class="grid grid-cols-7 gap-2 w-full"></div>
  </div>

  <!-- (D) EVENT FORM -->
  <dialog id="calForm"
          class="flex flex-col items-center justify-center bg-white p-4 rounded-lg shadow-lg">
    <form method="dialog" class="w-full max-w-md">
      <div id="evtCX" class="fa fa-close"></div>
      <h3 class="calForm">CALENDAR EVENT</h3>
      <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label class="block text-sm font-medium text-gray-700">Start</label>
          <input id="evtStart" type="datetime-local" required
                 class="mt-1 p-2 w-full border rounded-md">
        </div>
        <div class="w-full md:w-1/2 px-2">
          <label class="block text-sm font-medium text-gray-700">End</label>
          <input id="evtEnd" type="datetime-local" required
                 class="mt-1 p-2 w-full border rounded-md">
        </div>
      </div>
      <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label class="block text-sm font-medium text-gray-700">Text Color</label>
          <input id="evtColor" type="color" value="#645e5e" required
                 class="mt-1 p-2 w-full border rounded-md">
        </div>
        <div class="w-full md:w-1/2 px-2">
          <label class="block text-sm font-medium text-gray-700">Background Color</label>
          <input id="evtBG" type="color" value="#ffdbdb" required
                 class="mt-1 p-2 w-full border rounded-md">
        </div>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Event</label>
        <input id="evtTxt" type="text" autocomplete="off" required
               class="mt-1 p-2 w-full border rounded-md">
      </div>
      <div class="flex justify-between">
        <input type="hidden" id="evtID">
        <input type="button" id="evtDel" value="Delete"
               class="px-4 py-2 border rounded-md bg-red-500 text-white cursor-pointer">
        <input type="submit" id="evtSave" value="Save"> 
      </div>
    </form>
  </dialog>

  <?php
    include 'events.php';
  ?>

</body>

</html>
