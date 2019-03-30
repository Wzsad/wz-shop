<?php
/**
 * Class Controller
 *
 * @package App\Http\Controllers
 *
 * @SWG\Swagger(
 *     basePath="",
 *     host="homestead.test",
 *     schemes={"http","https"},
 *    @SWG\SecurityScheme(
 *    securityDefinition="passport",
 *    type="oauth2",
 *    tokenUrl="/oauth/token",
 *    flow="password",
 *    scopes={}
 *    ),
 *     @SWG\Info(
 *         version="3.0",
 *         title="OpenApi",
 *         @SWG\Contact(name="Pek Ratanak", url="https://www.google.com"),
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
