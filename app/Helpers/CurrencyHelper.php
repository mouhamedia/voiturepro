<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Format une somme en XOF (Franc CFA Sénégal)
     * Exemple: 1000 -> "1 000 XOF"
     */
    public static function formatXOF($amount)
    {
        // Arrondir au nombre entier le plus proche
        $amount = round($amount);
        
        // Formater avec espace comme séparateur de milliers
        return number_format($amount, 0, ',', ' ') . ' XOF';
    }

    /**
     * Format court pour les cartes (ex: "1.2M XOF" pour 1,200,000)
     */
    public static function formatXOFShort($amount)
    {
        $amount = round($amount);
        
        if ($amount >= 1000000) {
            return number_format($amount / 1000000, 1, ',', '') . 'M XOF';
        } elseif ($amount >= 1000) {
            return number_format($amount / 1000, 0) . 'K XOF';
        }
        
        return number_format($amount, 0, ',', ' ') . ' XOF';
    }

    /**
     * Format pour les prix dans les tableaux
     */
    public static function formatPrice($amount)
    {
        return self::formatXOF($amount);
    }

    /**
     * Obtenir le symbole XOF
     */
    public static function getSymbol()
    {
        return 'XOF';
    }
}
