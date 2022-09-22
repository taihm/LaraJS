<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 */

/**
 * @OA\Get(
 *     path="/staff",
 *     tags={"Staff"},
 *     summary="List Staff",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(
 *          name="search",
 *          in="query",
 *          @OA\Schema (type="string")
 *     ),
 *     @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          @OA\Schema (type="integer")
 *     ),
 *     @OA\Parameter(
 *          name="ascending",
 *          in="query",
 *          description="0: asc, 1: desc",
 *          @OA\Schema (type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *          name="page",
 *          in="query",
 *          @OA\Schema (type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *          name="orderBy",
 *          in="query",
 *          description="column order by",
 *          @OA\Schema (type="string", default="updated_at")
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Post(
 *     path="/staff",
 *     tags={"Staff"},
 *     summary="Create Staff",
 *     security={{"authApi":{}}},
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "building_id","user_id","staff_position_id","status"},
 *                  @OA\Property(property="building_id", type="INT", default="NONE", example="1046", description=""),
     *                  @OA\Property(property="user_id", type="INT", default="NONE", example="5859", description=""),
     *                  @OA\Property(property="staff_position_id", type="INT", default="NONE", example="5766", description=""),
     *                  @OA\Property(property="status", type="INT", default="NONE", example="2980", description=""),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 * @OA\Get(
 *     path="/staff/{id}",
 *     tags={"Staff"},
 *     summary="Edit Staff",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Put(
 *     path="/staff/{id}",
 *     tags={"Staff"},
 *     summary="Update Staff",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "building_id","user_id","staff_position_id","status"},
 *                  @OA\Property(property="building_id", type="INT", default="NONE", example="1046", description=""),
     *                  @OA\Property(property="user_id", type="INT", default="NONE", example="5859", description=""),
     *                  @OA\Property(property="staff_position_id", type="INT", default="NONE", example="5766", description=""),
     *                  @OA\Property(property="status", type="INT", default="NONE", example="2980", description=""),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Delete(
 *     path="/staff/{id}",
 *     tags={"Staff"},
 *     summary="Delete Staff",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 */

/**
 * @OA\Schema(
 *     type="object",
 *     title="Staff",
 *     required={"id", "building_id","user_id","staff_position_id","status"},
 * )
 */
class Staff
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * <###> @OA\Property(property="building_id", type="INT", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="user_id", type="INT", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="staff_position_id", type="INT", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="status", type="INT", default="NONE", description="")
     */

    //{{SWAGGER_PROPERTY_NOT_DELETE_THIS_LINE}}

    /**
     * @OA\Property(property="created_at", type="TIMESTAMP", default="NULL", description="")
     */

    /**
     * @OA\Property(property="updated_at", type="TIMESTAMP", default="NULL", description="")
     */

    
}
