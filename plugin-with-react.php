<?php
/**
* Plugin Name: Plugin with React
* Description: A WordPress plugin that uses React.js
* Version: 1.0
* Author: Your Name
*/
/*
คำสั่ง `if ( ! define( 'ABSPATH' ) ) : exit();
endif ();
` ใน WordPress มักใช้เพื่อเพิ่มความปลอดภัยในไฟล์ PHP ของปลักอินหรือธีม

1. `! define( 'ABSPATH' )`: ตรวจสอบว่าค่าคงที่ `ABSPATH` ได้ถูกกำหนดหรือไม่
2. `exit()`: ถ้า `ABSPATH` ไม่ถูกกำหนด, คำสั่ง `exit()` จะถูกเรียกใช้, หยุดการทำงานของสคริปต์
3. `endif;
`: สิ้นสุดบล็อค `if`

หากค่าคงที่ `ABSPATH` ไม่ถูกกำหนด, สคริปต์จะหยุดการทำงาน เนื่องจากไม่พบค่าคงที่นี้ ส่วนใหญ่จะหมายถึงว่าไฟล์ PHP นั้นถูกเข้าถึงโดยตรง ซึ่งเป็นการป้องกันวิธีเข้าถึงไฟล์ที่ไม่ปลอดภัย

ถ้าไม่มีการป้องกัน ใครก็ตามสามารถเรียกใช้ example-plugin.php ผ่าน URL โดยตรง เช่น http://yourdomain.com/wp-content/plugins/example-plugin/example-plugin.php
การใส่ if ( ! define( 'ABSPATH' ) ) : exit();
endif ();
ในที่ประกาศแรกของไฟล์ example-plugin.php จะช่วยป้องกันสถานการณ์แบบนี้ โดยหยุดการทำงานของสคริปต์ถ้ามันไม่ถูกเรียกใช้จากภายใน WordPress ที่ปลอดภัย

*/
if ( ! define( 'ABSPATH' ) ) : exit();
endif ();
?>
