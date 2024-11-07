import moment = require("moment");
import { getRepository, getConnection } from "typeorm";
import { CilFrequency } from "../output/entities/CilFrequency";
import { CilTask } from "../output/entities/CilTask";
import { CilTools } from "../output/entities/CilTools";
import { CilType } from "../output/entities/CilType";

export const GetCilMasterData = async (req, res, next) => {
    try {

        const cilType = await getRepository(CilType).find({ where: { isDeleted: null } });
        const cilTool = await getRepository(CilTools).find({ where: { isDeleted: null } });
        const cilFrequency = await getRepository(CilFrequency).find({ where: { isDeleted: null } });
        const cilTask = await getRepository(CilTask).find({ where: { isDeleted: null } });

        const result = {
            status: true,
            message: 'Cil Master Data',
            data: {
                cilType: cilType, 
                cilTool: cilTool,
                cilFrequency: cilFrequency, 
                cilTask: cilTask
            }
        };

        return res.status(200).send(result);
    }

    catch (err) {
        if (!err.statusCode) {
            err.statusCode = 500;
        }
        next(err);
    }
}

export const UploadCilMasterData = async (req, res, next) => {
    try {
        //Create Type Master Data
        if (req.body.TypeMasterData && req.body.TypeMasterData.length) {
                // console.log('req.body.TypeMasterData',req.body.TypeMasterData);
                // for(const line of req.body.TypeMasterData){
                //     const createType = await getConnection()
                //         .createQueryBuilder()
                //         .insert()
                //         .into(CilType)
                //         .values(line)
                //         .execute();

                //     if (createType && createType.identifiers && createType.identifiers[0] && createType.identifiers[0].id){
                //         let id = createType.identifiers[0].id;
                //     }
                // }
        }

        //Create Tool Master Data
        if (req.body.ToolsMasterData && req.body.ToolsMasterData.length) {
            // console.log('req.body.ToolsMasterData',req.body.ToolsMasterData);

            // for(const line of req.body.ToolsMasterData){
            //     const createTool = await getConnection()
            //         .createQueryBuilder()
            //         .insert()
            //         .into(CilTools)
            //         .values(line)
            //         .execute();

            //     if (createTool && createTool.identifiers && createTool.identifiers[0] && createTool.identifiers[0].id){
            //         let id = createTool.identifiers[0].id;
            //     }
            // }
        }

        //Create Frequency Master Data
        if (req.body.FrequencyMasterData && req.body.FrequencyMasterData.length) {
            // console.log('req.body.FrequencyMasterData',req.body.FrequencyMasterData);

            for(const line of req.body.FrequencyMasterData){
                line.nextRunDuration = line.referenceTime;
                line.firstNextTime = line.nextTime;

                // line.days = Math.floor(line.nextRunDuration / 1440);
                // line.hours = Math.floor((line.nextRunDuration % 1440)/60)
                // line.minutes = line.nextRunDuration % 60;

                var duration = moment.duration(line.nextRunDuration, 'minutes');
                line.days = duration.days();
                if(line.days == 0){
                    line.hours = duration.hours();
                    if(line.hours == 0){
                        line.minutes = line.nextRunDuration;
                    }
                    else{
                        line.days = 0;
                        line.minutes = 0;
                    }
                }
                else{
                    line.hours = 0;
                    line.minutes = 0;
                }

                // const createFrequency = await getConnection()
                //     .createQueryBuilder()
                //     .insert()
                //     .into(CilFrequency)
                //     .values(line)
                //     .execute();

                // if (createFrequency && createFrequency.identifiers && createFrequency.identifiers[0] && createFrequency.identifiers[0].id){
                //     let id = createFrequency.identifiers[0].id;
                // }
            }


        }

        //Create Task Master Data
        if (req.body.TaskMasterData && req.body.TaskMasterData.length) {
            // console.log('req.body.TaskMasterData',req.body.TaskMasterData);

            for(const line of req.body.TaskMasterData){

            //   id:"",
            //   egId: this.CilmainDataForm.value.group,
            //   plantId: this.CilmainDataForm.value.plant,
            //   machineId:"",
            //   componentId:"",
            //   typeId:"",
            //   taskName:"",
            //   remarks:"",
            //   frequencyId:"",
            //   estimatedTime:"",
            //   toolIds:[],
            //   userids:[],
            //   createdOn:"",
            //   userId:0

                line.unitId = line.machineId;
                line.cilTypeId = line.typeId;
                line.cilFrequencyId = line.frequencyId;

                const createTask = await getConnection()
                    .createQueryBuilder()
                    .insert()
                    .into(CilTask)
                    .values(line)
                    .execute();

                // if (createTask && createTask.identifiers && createTask.identifiers[0] && createTask.identifiers[0].id){
                //     let id = createTask.identifiers[0].id;
                // }
            }
        }

        let Result = {
            status: true,
            message: 'Master Data Uploaded Successfully'
        };
        return res.status(200).send(Result);
    }
    catch (err) {
        if (!err.statusCode) {
            err.statusCode = 500;
        }
        next(err);
    }
}