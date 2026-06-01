<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: {
        title: 'Bienvenido a NAFIAPP',
        description: 'Inicia sesión de forma segura con tu cuenta de Google',
    },
});

defineProps<{
    status?: string;
    canResetPassword?: boolean;
}>();
</script>

<template>
    <Head title="Iniciar sesión" />

    <div class="flex flex-col gap-6">
        <!-- Status Alert -->
        <div
            v-if="status"
            class="rounded-lg border border-green-200 bg-green-50/50 p-4 text-center text-sm font-medium text-green-700 dark:border-green-900/30 dark:bg-green-950/20 dark:text-green-400"
        >
            {{ status }}
        </div>

        <!-- Auth Error Alert -->
        <div
            v-if="
                $page.props.errors && Object.keys($page.props.errors).length > 0
            "
            class="rounded-lg border border-red-200 bg-red-50/50 p-4 text-sm text-red-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-red-400"
        >
            <div class="flex items-center gap-2 font-medium">
                <svg
                    class="h-4 w-4 shrink-0"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"
                    />
                </svg>
                <span>Error de autenticación</span>
            </div>
            <p class="mt-1 text-xs opacity-90">
                {{
                    $page.props.errors.email ||
                    Object.values($page.props.errors)[0]
                }}
            </p>
        </div>

        <!-- Premium Google Login Card -->
        <div
            class="relative overflow-hidden rounded-2xl border border-border bg-card p-6 shadow-sm transition-all duration-300 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900/50 dark:backdrop-blur-xl"
        >
            <!-- Glow background effect -->
            <div
                class="absolute -top-10 -right-10 h-24 w-24 rounded-full bg-blue-500/10 blur-2xl"
            ></div>
            <div
                class="absolute -bottom-10 -left-10 h-24 w-24 rounded-full bg-purple-500/10 blur-2xl"
            ></div>

            <div class="relative flex flex-col items-center gap-5 text-center">
                <p class="text-sm leading-relaxed text-muted-foreground">
                    Para proteger tus datos y simplificar el acceso, NAFIAPP
                    utiliza el inicio de sesión único de Google. No necesitas
                    recordar contraseñas adicionales.
                </p>

                <!-- Google Auth Button -->
                <a
                    href="/auth/google"
                    class="group relative flex w-full items-center justify-center gap-3 rounded-xl border border-input bg-background px-4 py-3.5 text-sm font-semibold shadow-sm transition-all duration-300 hover:scale-[1.02] hover:border-zinc-400 hover:bg-accent hover:text-accent-foreground focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:scale-[0.98] dark:border-zinc-800 dark:bg-zinc-950 dark:hover:border-zinc-700"
                >
                    <svg
                        class="h-5 w-5 transition-transform duration-300 group-hover:scale-110"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4"
                        />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853"
                        />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05"
                        />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335"
                        />
                    </svg>
                    <span>Iniciar sesión con Google</span>
                </a>
            </div>
        </div>

        <div class="text-center text-xs text-muted-foreground/80">
            Al continuar, aceptas nuestros
            <a
                href="#"
                class="underline underline-offset-2 hover:text-foreground"
                >Términos de Servicio</a
            >
            y
            <a
                href="#"
                class="underline underline-offset-2 hover:text-foreground"
                >Política de Privacidad</a
            >.
        </div>
    </div>
</template>
