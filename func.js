// const emailInput = document.getElementById("email");
// const emailFeedback = document.getElementById("emailFeedback");

// // ฟังก์ชันตรวจสอบรูปแบบอีเมล
// function validateEmail(email) {
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return emailRegex.test(email);
// }

// // จับ Event 'input' เพื่อตรวจสอบทุกครั้งที่กรอก
// emailInput.addEventListener("input", function () {
//     if (emailInput.value === "") {
//         emailFeedback.style.display = "none"; // ไม่ต้องแสดงอะไรหากว่าง
//     } else if (validateEmail(emailInput.value)) {
//         emailFeedback.style.display = "none"; // ซ่อนข้อความถ้ารูปแบบถูกต้อง
//     } else {
//         emailFeedback.style.display = "block"; // แสดงข้อความถ้ารูปแบบไม่ถูกต้อง
//     }
// });

$(document).ready(function () {
    // ฟังก์ชันตรวจสอบรูปแบบอีเมล
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?$/;

        return emailRegex.test(email); // คืนค่า true ถ้ารูปแบบถูกต้อง
    }
    function validateNum(num) {
        const numRegex = /[0-9]$/;

        return numRegex.test(num); // คืนค่า true ถ้ารูปแบบถูกต้อง
    }

    // ตรวจสอบเมื่อมีการพิมพ์ในช่องอีเมล
    $("#email").on("input", function () {
        const email = $(this).val().trim(); // ตัดช่องว่างออก
        if (email === "") {
            $("#emailFeedback").hide(); // ไม่ต้องแสดงอะไรถ้าช่องว่าง
        } else if (validateEmail(email)) {
            $("#emailFeedback").hide(); // ซ่อนข้อความถ้ารูปแบบถูกต้อง
        } else {
            $("#emailFeedback").show(); // แสดงข้อความถ้ารูปแบบไม่ถูกต้อง
        }
    });

    // ตรวจสอบเมื่อมีการพิมพ์ในช่องอีเมล
    $("#num").on("input", function () {
        const num = $(this).val(); // ตัดช่องว่างออก
        if (num === "") {
            $("#numFeedback").hide(); // ไม่ต้องแสดงอะไรถ้าช่องว่าง
        } else if (validateNum(num)) {
            $("#numFeedback").hide(); // ซ่อนข้อความถ้ารูปแบบถูกต้อง
        } else {
            $("#numFeedback").show(); // แสดงข้อความถ้ารูปแบบไม่ถูกต้อง
        }
    });
    
    // ฟังก์ชันเพื่อเปลี่ยนธีม
    function setTheme(theme) {
        let themeIcon;
  
        if (theme === 'auto') {
          const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
          $('html').attr('data-bs-theme', isDarkMode ? 'dark' : 'light');
          themeIcon = isDarkMode ? '#moon-stars-fill' : '#sun-fill'; // เลือกไอคอนตามโหมด
        } else {
          $('html').attr('data-bs-theme', theme);
          themeIcon = theme === 'dark' ? '#moon-stars-fill' : '#sun-fill'; // เลือกไอคอนตามธีม
        }
  
        // เปลี่ยนไอคอนในปุ่ม
        $('#bd-theme svg').attr('href', themeIcon);
  
        // ทำเครื่องหมายปุ่มที่เลือก
        $('.dropdown-item').removeClass('active');
        $(`button[data-bs-theme-value="${theme}"]`).addClass('active');
  
        // บันทึกธีมที่เลือกใน localStorage
        localStorage.setItem('theme', theme);
      }
  
      // ตรวจสอบธีมที่เก็บใน localStorage หรือใช้ค่าเริ่มต้นเป็น 'auto'
      const savedTheme = localStorage.getItem('theme') || 'auto';
      setTheme(savedTheme);
  
      // อัปเดตธีมเมื่อผู้ใช้เปลี่ยนการตั้งค่าในระบบ (เช่นจาก Light ไป Dark หรือกลับกัน)
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'auto') {
          setTheme('auto');
        }
      });
  
      // เมื่อคลิกที่ปุ่มใน dropdown ให้เปลี่ยนธีม
      $('.dropdown-item').click(function() {
        const selectedTheme = $(this).data('bs-theme-value');
        setTheme(selectedTheme);
      });
    });
    $(document).ready(function() {
      // เมื่อหน้าโหลด ให้ตรวจสอบและตั้งค่า theme และไอคอน
      function setThemeFromLocalStorage() {
        var storedTheme = localStorage.getItem('theme') || 'dark'; // ถ้าไม่มีค่า theme เก็บไว้ จะตั้งค่าเป็น 'dark'
        var iconElement = $('#theme-icon');
  
        // ตั้งค่าไอคอนตามธีมที่เก็บไว้
        switch (storedTheme) {
          case 'light':
            iconElement.attr('href', '#sun-fill');
            break;
          case 'dark':
            iconElement.attr('href', '#moon-stars-fill');
            break;
          case 'auto':
            iconElement.attr('href', '#circle-half');
            break;
        }
  
        // ตั้งค่าปุ่ม active ตามธีมที่เก็บไว้
        $('[data-bs-theme-value]').removeClass('active');
        $('[data-bs-theme-value="' + storedTheme + '"]').addClass('active');
      }
  
      // เมื่อผู้ใช้เลือกธีม
      $('[data-bs-theme-value]').on('click', function() {
        var themeValue = $(this).attr('data-bs-theme-value');
        var iconElement = $('#theme-icon');
  
        // เปลี่ยนไอคอนในปุ่มตามธีมที่เลือก
        switch (themeValue) {
          case 'light':
            iconElement.attr('href', '#sun-fill');
            break;
          case 'dark':
            iconElement.attr('href', '#moon-stars-fill');
            break;
          case 'auto':
            iconElement.attr('href', '#circle-half');
            break;
        }
  
        // เก็บค่าธีมที่เลือกใน localStorage
        localStorage.setItem('theme', themeValue);
  
        // เปลี่ยนสถานะ active ของเมนู
        $('[data-bs-theme-value]').removeClass('active');
        $(this).addClass('active');
      });
  
      // ตั้งค่าธีมและไอคอนเมื่อโหลดหน้าใหม่
      setThemeFromLocalStorage();
});
