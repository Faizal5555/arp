const express = require('express');
const router = express.Router();
import { GetCilMasterData,UploadCilMasterData } from '../controller/cil-bulkupload.controller';

router.get("/getCilMasterData", GetCilMasterData);
router.post("/uploadCilMasterData", UploadCilMasterData);
// router.post("/updateClassifcation", UpdateClassifcation);

module.exports = router;