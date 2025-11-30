<?php

declare(strict_types=1);

namespace Unnits\BankId\OIDC;

use Unnits\BankId\Enums\AcrValue;
use Unnits\BankId\Enums\CodeChallengeMethod;
use Unnits\BankId\Enums\ResponseType;
use Unnits\BankId\Enums\Scope;
use Unnits\BankId\Enums\SigningAlgorithm;
use Unnits\BankId\Enums\SubjectType;
use Unnits\BankId\OAuth2\GrantType;
use Unnits\BankId\OAuth2\ResponseMode;

readonly class Configuration
{
    /**
     * @param Scope[] $supportedScopes
     * @param ResponseType[] $supportedResponseTypes
     * @param SubjectType[] $supportedSubjectTypes
     * @param string[] $supportedIdTokenSigningAlgValues
     * @param ?string[] $supportedResponseModes
     * @param ?GrantType[] $supportedGrantTypes
     * @param ?AcrValue[] $supportedAcrValues
     * @param ?CodeChallengeMethod[] $supportedCodeChallengeMethods
     * @param ?string[] $supportedIdTokenEncryptionAlgValues
     * @param ?string[] $supportedIdTokenEncryptionEncValues
     * @param ?string[] $supportedUserinfoSigningAlgValues
     * @param ?string[] $supportedUserinfoEncryptionEncValues
     * @param ?string[] $supportedProfileSigningAlgValues
     * @param ?string[] $supportedProfileEncryptionAlgValues
     * @param ?string[] $supportedProfileEncryptionEncValues
     * @param ?string[] $supportedRequestObjectSigningAlgValues
     * @param ?string[] $supportedRequestObjectEncryptionAlgValues
     * @param ?string[] $supportedRequestObjectEncryptionEncValues
     */
    public function __construct(
        public string $issuer,
        public string $authorizationEndpoint,
        public string $tokenEndpoint,
        public string $jwksUri,
        public array $supportedScopes,
        public array $supportedResponseTypes,
        public array $supportedSubjectTypes,
        public array $supportedIdTokenSigningAlgValues,
        public string $checkSessionIframe,
        public string $endSessionEndpoint,
        public ?string $userinfoEndpoint = null,
        public ?string $profileEndpoint = null,
        public ?string $rosEndpoint = null,
        public ?string $authorizeEndpoint = null,
        public ?string $verificationEndpoint = null,
        public ?string $introspectionEndpoint = null,
        public ?array $supportedResponseModes = null,
        public ?array $supportedGrantTypes = null,
        public ?array $supportedAcrValues = null,
        public ?array $supportedCodeChallengeMethods = null,
        public ?array $supportedIdTokenEncryptionAlgValues = null,
        public ?array $supportedIdTokenEncryptionEncValues = null,
        public ?array $supportedUserinfoSigningAlgValues = null,
        public ?array $supportedUserinfoEncryptionAlgValues = null,
        public ?array $supportedUserinfoEncryptionEncValues = null,
        public ?array $supportedProfileSigningAlgValues = null,
        public ?array $supportedProfileEncryptionAlgValues = null,
        public ?array $supportedProfileEncryptionEncValues = null,
        public ?array $supportedRequestObjectSigningAlgValues = null,
        public ?array $supportedRequestObjectEncryptionAlgValues = null,
        public ?array $supportedRequestObjectEncryptionEncValues = null,
        public ?array $supportedTokenEndpointAuthMethods = null,
        public ?array $supportedTokenEndpointAuthSigningAlgValues = null,
        public ?array $supportedIntrospectionEndpointAuthMethods = null,
        public ?array $supportedIntrospectionEndpointAuthSigningAlgValues = null,
        public ?array $supportedDisplayValues = null,
        public ?string $serviceDocumentation = null,
        public ?array $supportedClaimsLocales = null,
        public ?array $supportedUiLocales = null,
        public ?bool $claimsParameterSupported = null,
        public ?bool $requestParameterSupported = null,
        public ?bool $requestUriParameterSupported = null,
        public ?bool $requiredRequestUriRegistration = null,
        public ?string $opPolicyUri = null,
        public ?string $opTosUri = null,
        public ?bool $backChannelLogoutSupported = null,
        public ?bool $backChannelLogoutSessionSupported = null,
        public ?array $supportedClaims = null,
        public ?bool $frontChannelLogoutSupported = null,
        public ?bool $frontChannelLogoutSessionSupported = null,
    ) {
        //
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        return new self(
            issuer: (string)$data['issuer'],
            authorizationEndpoint: (string)$data['authorization_endpoint'],
            tokenEndpoint: (string)$data['token_endpoint'],
            jwksUri: (string)$data['jwks_uri'],
            supportedScopes: Scope::collectionFromArray($data['scopes_supported'] ?? []),
            supportedResponseTypes: ResponseType::collectionFromArray($data['response_types_supported'] ?? []),
            supportedSubjectTypes: SubjectType::collectionFromArray($data['subject_types_supported'] ?? []),
            supportedIdTokenSigningAlgValues: $data['id_token_signing_alg_values_supported'] ?? null,
            checkSessionIframe: (string)$data['check_session_iframe'],
            endSessionEndpoint: (string)$data['end_session_endpoint'],
            userinfoEndpoint: $data['userinfo_endpoint'] ?? null,
            profileEndpoint: $data['profile_endpoint'] ?? null,
            rosEndpoint: $data['ros_endpoint'] ?? null,
            authorizeEndpoint: $data['authorize_endpoint'] ?? null,
            verificationEndpoint: $data['verification_endpoint'] ?? null,
            introspectionEndpoint: $data['introspection_endpoint'] ?? null,
            supportedResponseModes: array_key_exists('response_modes_supported', $data)
                ? ResponseMode::collectionFromArray($data['response_modes_supported'] ?? [])
                : null,
            supportedGrantTypes: array_key_exists('grant_types_supported', $data)
                ? GrantType::collectionFromArray($data['grant_types_supported'] ?? [])
                : null,
            supportedAcrValues: array_key_exists('acr_values_supported', $data)
                ? AcrValue::collectionFromArray($data['acr_values_supported'] ?? [])
                : null,
            supportedCodeChallengeMethods: array_key_exists('code_challenge_methods_supported', $data)
                ? CodeChallengeMethod::collectionFromArray($data['code_challenge_methods_supported'] ?? [])
                : null,
            supportedIdTokenEncryptionAlgValues: $data['id_token_encryption_alg_values_supported'] ?? null,
            supportedIdTokenEncryptionEncValues: $data['id_token_encryption_enc_values_supported'] ?? null,
            supportedUserinfoSigningAlgValues: $data['userinfo_signing_alg_values_supported'] ?? null,
            supportedUserinfoEncryptionAlgValues: $data['userinfo_encryption_alg_values_supported'] ?? null,
            supportedUserinfoEncryptionEncValues: $data['userinfo_encryption_enc_values_supported'] ?? null,
            supportedProfileSigningAlgValues: $data['profile_signing_alg_values_supported'] ?? null,
            supportedProfileEncryptionAlgValues: $data['profile_encryption_alg_values_supported'] ?? null,
            supportedProfileEncryptionEncValues: $data['profile_encryption_enc_values_supported'] ?? null,
            supportedRequestObjectSigningAlgValues: $data['request_object_signing_alg_values_supported'] ?? null,
            supportedRequestObjectEncryptionAlgValues: $data['request_object_encryption_alg_values_supported'] ?? null,
            supportedRequestObjectEncryptionEncValues: $data['request_object_encryption_enc_values_supported'] ?? null,
            supportedTokenEndpointAuthMethods: $data['token_endpoint_auth_methods_supported'] ?? null,
            supportedTokenEndpointAuthSigningAlgValues:
                $data['token_endpoint_auth_signing_alg_values_supported'] ?? null,
            supportedIntrospectionEndpointAuthMethods: $data['introspection_endpoint_auth_methods_supported'] ?? null,
            supportedIntrospectionEndpointAuthSigningAlgValues:
                $data['introspection_endpoint_auth_signing_alg_values_supported'] ?? null,
            supportedDisplayValues: $data['display_values_supported'] ?? null,
            serviceDocumentation: $data['service_documentation'] ?? null,
            supportedClaimsLocales: $data['claims_locales_supported'] ?? null,
            supportedUiLocales: $data['ui_locales_supported'] ?? null,
            claimsParameterSupported: $data['claims_parameter_supported'] ?? null,
            requestParameterSupported: $data['request_parameter_supported'] ?? null,
            requestUriParameterSupported: $data['request_uri_parameter_supported'] ?? null,
            requiredRequestUriRegistration: $data['require_request_uri_registration'] ?? null,
            opPolicyUri: $data['op_policy_uri'] ?? null,
            opTosUri: $data['op_tos_uri'] ?? null,
            backChannelLogoutSupported: $data['backchannel_logout_supported'] ?? null,
            backChannelLogoutSessionSupported: $data['backchannel_logout_session_supported'] ?? null,
            supportedClaims: $data['claims_supported'] ?? null,
            frontChannelLogoutSupported: array_key_exists('frontchannel_logout_supported', $data)
                ? (bool)$data['frontchannel_logout_supported']
                : null,
            frontChannelLogoutSessionSupported: array_key_exists('frontchannel_logout_session_supported', $data)
                ? (bool)$data['frontchannel_logout_session_supported']
                : null,
        );
    }
}
